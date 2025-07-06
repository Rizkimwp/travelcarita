<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    //

    public function index(Request $request)
    {
        try {

            $query = Layanan::query();
            $fasilitasList = Fasilitas::get();
            // Jika ada pencarian, tambahkan filter
            if ($request->filled('search')) {
                $query->whereHas('fasilitas', function ($q) use ($request) {
                    $q->where('nama_fasilitas', 'like', '%'.$request->input('search').'%');
                });
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $layanan = $query->paginate($perPage);

            return view('admin.pages.layanan', compact('layanan', 'fasilitasList'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    //
    public function store(Request $request)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:fasilitas,id',
            'title' => 'required|string|max:255',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'harga' => 'required|numeric|min:0',
        ]);

        $path = null;

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $path = $file->store('galeri', 'public'); // hasil: galeri/namafile.jpg
        }

        try {
            Layanan::create([
                'id_fasilitas' => $request->id_fasilitas,
                'path' => $path,
                'title' => $request->title,
                'harga' => $request->harga,
            ]);

            return redirect()->back()->with('success', 'Layanan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:fasilitas,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'harga' => 'required|numeric|min:0',
            'title' => 'required|string|max:255',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        try {
            $layanan = Layanan::findOrFail($id);

            // Simpan file baru jika ada
            if ($request->hasFile('path')) {
                // Hapus file lama jika ada
                if ($layanan->path && Storage::disk('public')->exists($layanan->path)) {
                    Storage::disk('public')->delete($layanan->path);
                }

                $file = $request->file('path');
                $path = $file->store('galeri', 'public'); // hasil: galeri/namafile.jpg
            } else {
                $path = $layanan->path; // tetap pakai path lama
            }

            $layanan->update([
                'id_fasilitas' => $request->id_fasilitas,
                'title' => $request->title,
                'path' => $path,
                'harga' => $request->harga,
                'lama_sewa' => $request->lama_sewa,
            ]);

            return redirect()->back()->with('success', 'Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $fasilitas = Layanan::findOrFail($id);

            $fasilitas->delete();

            return redirect()->back()->with('success', 'Jenis Paket berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: '.$e->getMessage());
        }
    }
}