<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\Fasilitas;
use App\Models\FasilitasPaket;
use App\Models\GaleriPaket;
use App\Models\Itinerari;
use App\Models\Jadwal;
use App\Models\JenisPaket;
use App\Models\Maps;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    //
    public function index(Request $request)
    {
        try {

            $query = PaketWisata::query();

            // Jika ada pencarian, tambahkan filter
            if ($request->has('search')) {
                $query->where('nama_paket', 'like', '%'.$request->input('search').'%');
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $paketWisata = $query->with('galeri')->paginate($perPage);

            return view('admin.pages.paket-wisata', compact('paketWisata'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    public function create()
    {
        $jenisPaket = JenisPaket::get();

        $fasilitas = Fasilitas::get();

        return view('admin.components.extends.create-paket', compact('jenisPaket', 'fasilitas'));
    }

    public function edit($id)
    {
        try {
            $paketWisata = PaketWisata::with(['jadwal', 'itinerari', 'fasilitasPaket.fasilitas', 'galeri', 'faqs', 'maps'])
                ->findOrFail($id);

            $jenisPaket = JenisPaket::get();
            $fasilitas = Fasilitas::get();

            return view('admin.components.extends.edit-paket', compact('paketWisata', 'jenisPaket', 'fasilitas'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error('Edit PaketWisata failed: '.$th->getMessage());

            return redirect()->back()->with('error', 'Paket wisata tidak ditemukan atau terjadi kesalahan.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_paket' => 'required|exists:jenis_paket,id',
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'durasi_hari' => 'required|integer|min:1',
            'jadwal_keberangkatan' => 'required|date|after_or_equal:today',

            'itinerari' => 'nullable|array',
            'itinerari.*.hari_ke' => 'required_with:itinerari|integer|min:1',
            'itinerari.*.kegiatan' => 'required_with:itinerari|string',
            'itinerari.*.waktu' => 'nullable|string',

            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id',

            'galeri' => 'nullable|array',
            'galeri.*' => 'file|image|mimes:jpeg,png|max:2048',

            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:255',
            'faqs.*.answer' => 'required_with:faqs|string',

            'maps' => 'nullable|string',
        ], [
            'id_jenis_paket.required' => 'Jenis paket wajib dipilih.',
            'jadwal_keberangkatan.after_or_equal' => 'Tanggal keberangkatan tidak boleh di masa lalu.',
            'galeri.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan Paket Wisata
            $paket = PaketWisata::create([
                'id_jenis_paket' => $request->id_jenis_paket,
                'nama_paket' => trim($request->nama_paket),
                'deskripsi' => trim($request->deskripsi),
                'harga' => $request->harga,
                'diskon' => $request->diskon,
                'durasi_hari' => $request->durasi_hari,
            ]);

            // 2. Simpan Jadwal Keberangkatan
            Jadwal::create([
                'id_paket' => $paket->id,
                'tanggal_berangkat' => $request->jadwal_keberangkatan,
                'sisa_kuota' => 0,
            ]);

            // 3. Itinerary
            foreach ($request->itinerari ?? [] as $item) {
                Itinerari::create([
                    'id_paket' => $paket->id,
                    'hari_ke' => $item['hari_ke'],
                    'kegiatan' => trim($item['kegiatan']),
                    'waktu' => $item['waktu'],
                ]);
            }

            // 4. Fasilitas
            foreach ($request->fasilitas ?? [] as $id_fasilitas) {
                FasilitasPaket::create([
                    'id_paket' => $paket->id,
                    'id_fasilitas' => $id_fasilitas,
                ]);
            }

            // 5. Galeri
            if ($request->hasFile('galeri')) {
                foreach ($request->file('galeri') as $file) {
                    $path = $file->store('galeri', 'public');

                    GaleriPaket::create([
                        'id_paket' => $paket->id,
                        'tipe' => 'foto',
                        'url_media' => $path,
                    ]);
                }
            }

            // 6. FAQs
            foreach ($request->faqs ?? [] as $faq) {
                $faq = (array) $faq;

                if (! isset($faq['question'], $faq['answer']) || trim($faq['question']) === '' || trim($faq['answer']) === '') {
                    Log::warning('FAQ skipped: incomplete or empty', $faq);

                    continue;
                }

                $inserted = Faqs::create([
                    'id_paket' => $paket->id,
                    'question' => trim($faq['question']),
                    'answer' => trim($faq['answer']),
                ]);

                Log::info('FAQ inserted:', $inserted->toArray());
            }

            // 7. Maps
            if ($request->filled('maps')) {
                Log::info('Processing maps insert');

                $insertmap = Maps::create([
                    'id_paket' => $paket->id,
                    'path' => trim($request->maps),
                ]);

                Log::info('Maps inserted:', $insertmap->toArray());
            }

            DB::commit();

            return redirect()->back()->with('success', 'Paket wisata berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store PaketWisata failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis_paket' => 'required|exists:jenis_paket,id',
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'durasi_hari' => 'required|integer|min:1',
            'jadwal_keberangkatan' => 'required|date|after_or_equal:today',

            'itinerari' => 'nullable|array',
            'itinerari.*.hari_ke' => 'required_with:itinerari|integer|min:1',
            'itinerari.*.kegiatan' => 'required_with:itinerari|string',
            'itinerari.*.waktu' => 'nullable|string',

            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id',

            'galeri' => 'nullable|array',
            'galeri.*' => 'file|image|mimes:jpeg,png|max:2048',

            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:255',
            'faqs.*.answer' => 'required_with:faqs|string',

            'maps' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $paket = PaketWisata::findOrFail($id);

            // 1. Update Paket Wisata
            $paket->update([
                'id_jenis_paket' => $request->id_jenis_paket,
                'nama_paket' => trim($request->nama_paket),
                'deskripsi' => trim($request->deskripsi),
                'harga' => $request->harga,
                'diskon' => $request->diskon,
                'durasi_hari' => $request->durasi_hari,
            ]);

            // 2. Update Jadwal
            Jadwal::updateOrCreate(
                ['id_paket' => $paket->id],
                ['tanggal_berangkat' => $request->jadwal_keberangkatan]
            );

            // 3. Refresh Itinerary
            Itinerari::where('id_paket', $paket->id)->delete();
            foreach ($request->itinerari ?? [] as $item) {
                Itinerari::create([
                    'id_paket' => $paket->id,
                    'hari_ke' => $item['hari_ke'],
                    'kegiatan' => trim($item['kegiatan']),
                    'waktu' => $item['waktu'],
                ]);
            }

            // 4. Refresh Fasilitas
            FasilitasPaket::where('id_paket', $paket->id)->delete();
            foreach ($request->fasilitas ?? [] as $id_fasilitas) {
                FasilitasPaket::create([
                    'id_paket' => $paket->id,
                    'id_fasilitas' => $id_fasilitas,
                ]);
            }

            // 5. Tambah Galeri Baru (jika ada)
            if ($request->hasFile('galeri')) {
                foreach ($request->file('galeri') as $file) {
                    $path = $file->store('galeri', 'public');

                    GaleriPaket::create([
                        'id_paket' => $paket->id,
                        'tipe' => 'foto',
                        'url_media' => $path,
                    ]);
                }
            }

            // 6. Refresh FAQs
            Faqs::where('id_paket', $paket->id)->delete();
            foreach ($request->faqs ?? [] as $faq) {
                if (! isset($faq['question'], $faq['answer']) || trim($faq['question']) === '' || trim($faq['answer']) === '') {
                    continue;
                }

                Faqs::create([
                    'id_paket' => $paket->id,
                    'question' => trim($faq['question']),
                    'answer' => trim($faq['answer']),
                ]);
            }

            // 7. Update Maps
            Maps::updateOrCreate(
                ['id_paket' => $paket->id],
                ['path' => trim($request->maps)]
            );

            DB::commit();

            return redirect()->route('paketwisata.index')->with('success', 'Paket wisata berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update PaketWisata failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $paket = PaketWisata::findOrFail($id);

            // Hapus semua relasi terkait
            Jadwal::where('id_paket', $paket->id)->delete();
            Itinerari::where('id_paket', $paket->id)->delete();
            FasilitasPaket::where('id_paket', $paket->id)->delete();

            $galeris = GaleriPaket::where('id_paket', $paket->id)->get();
            foreach ($galeris as $galeri) {
                Storage::disk('public')->delete($galeri->url_media); // hapus file dari storage
                $galeri->delete();
            }

            Faqs::where('id_paket', $paket->id)->delete();
            Maps::where('id_paket', $paket->id)->delete();

            // Hapus paket utama
            $paket->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Paket wisata berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete PaketWisata failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $paketWisata = PaketWisata::with(['jadwal', 'itinerari', 'fasilitasPaket.fasilitas', 'galeri', 'faqs', 'maps'])
                ->findOrFail($id);

            return view('admin.pages.view-paket-wisata', compact('paketWisata'));
        } catch (\Exception $e) {
            Log::error('View PaketWisata failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data paket wisata.');
        }
    }
}