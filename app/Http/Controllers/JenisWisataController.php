<?php

namespace App\Http\Controllers;

use App\Models\JenisPaket;
use Illuminate\Http\Request;

class JenisWisataController extends Controller
{
    //
    public function index(Request $request)
    {
        try {

            $query = JenisPaket::query();

            // Jika ada pencarian, tambahkan filter
            if ($request->has('search')) {
                $query->where('name', 'like', '%'.$request->input('search').'%');
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $jenisPaket = $query->paginate($perPage);

            return view('admin.pages.jenis-wisata', compact('jenisPaket'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    //
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:100|unique:jenis_paket,nama_paket',
        ]);

        try {
            JenisPaket::create([
                'nama_paket' => $request->nama_paket,
            ]);

            return redirect()->back()->with('success', 'Jenis Paket berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:100|unique:jenis_paket,nama_paket,'.$id,
        ]);

        try {
            $jenisPaket = JenisPaket::findOrFail($id);
            $jenisPaket->update([
                'nama_paket' => $request->nama_paket,
            ]);

            return redirect()->back()->with('success', 'Jenis Paket berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jenisPaket = JenisPaket::findOrFail($id);


            $jenisPaket->delete();

            return redirect()->back()->with('success', 'Jenis Paket berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: '.$e->getMessage());
        }
    }
}
