<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    //
    public function index(Request $request)
    {
        try {

            $query = Fasilitas::query();

            // Jika ada pencarian, tambahkan filter
            if ($request->has('search')) {
                $query->where('nama_fasilitas', 'like', '%'.$request->input('search').'%');
            }

            // Ambil limit per halaman (default 5)
            $perPage = $request->input('limit', 5);
            $perPage = in_array($perPage, [5, 10, 15]) ? $perPage : 5;

            // Gunakan paginate() agar pagination berfungsi dengan benar
            $fasilitas = $query->paginate($perPage);

            return view('admin.pages.fasilitas', compact('fasilitas'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    //
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas,nama_fasilitas',
        ]);

        try {
            Fasilitas::create([
                'nama_fasilitas' => $request->nama_fasilitas,
            ]);

            return redirect()->back()->with('success', 'Jenis Paket berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas,nama_fasilitas,'.$id,
        ]);

        try {
            $fasilitas = Fasilitas::findOrFail($id);
            $fasilitas->update([
                'nama_fasilitas' => $request->nama_fasilitas,
            ]);

            return redirect()->back()->with('success', 'Jenis Paket berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);


            $fasilitas->delete();

            return redirect()->back()->with('success', 'Jenis Paket berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: '.$e->getMessage());
        }
    }
}