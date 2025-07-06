<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Layanan;
use App\Models\PaketWisata;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    //
    public function index(Request $request)
    {
        try {

            $query = Pemesanan::query();

            // Jika ada pencarian, tambahkan filter
            if ($request->has('search')) {
                $query->where('name', 'like', '%'.$request->input('search').'%');
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $pemesanan = $query->paginate($perPage);

            return view('admin.pages.pemesanan', compact('pemesanan'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    public function create()
    {
        return view('admin.components.extends.create-pemesanan', [
            'users' => User::where('role', 'user')->get(),
            'paket_wisata' => PaketWisata::all(),
            'jadwals' => Jadwal::all(),
            'layanan' => Layanan::all(),
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'id_user' => 'required|exists:users,id',
        'id_paket' => 'required|exists:paket_wisata,id',
        'jumlah_peserta' => 'required|integer|min:1',
        'id_layanan' => 'nullable|exists:layanan,id',
        'total_harga' => 'required|numeric|min:0',
        'status_pembayaran' => 'required|in:dp,lunas',
        'jumlah' => 'required|numeric|min:0',
        'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'metode' => 'required|in:transfer,tunai',
    ]);

    try {
        // Upload bukti jika ada
        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('galeri', 'public');
        }

        // Buat data pemesanan
        $pemesanan = Pemesanan::create([
            'id_user' => $request->id_user,
            'id_paket' => $request->id_paket,
            'jumlah_peserta' => $request->jumlah_peserta,
            'id_layanan' => $request->id_layanan,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Buat data pembayaran
        Pembayaran::create([
            'id_pemesanan' => $pemesanan->id,
            'jumlah' => $request->jumlah,
            'status_verifikasi' => 'diterima',
            'metode' => $request->metode,
            'tipe' => $request->status_pembayaran,
            'bukti' => $path,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil disimpan.');
    } catch (\Exception $e) {
        Log::error('Store Pesanan failed: ' . $e->getMessage());

        return redirect()->back()->with('error', 'Gagal menyimpan data pesanan.');
    }
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_paket' => 'required|exists:paket_wisata,id',
            'id_jadwal' => 'required|exists:jadwal,id',
            'jumlah_peserta' => 'required|integer|min:1',
            'id_layanan' => 'nullable|exists:layanan,id',
            'total_harga' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum,lunas,cicil',
        ]);

        try {
            $pesanan = Pemesanan::findOrFail($id);
            $pesanan->update($request->all());

            return redirect()->back()->with('success', 'Pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Update Pesanan failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Gagal memperbarui data pesanan.');
        }
    }

    public function destroy($id)
    {
        try {
            $pesanan = Pemesanan::findOrFail($id);
            $pesanan->delete();

            return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Delete Pesanan failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Gagal menghapus pesanan: '.$e->getMessage());
        }
    }
}