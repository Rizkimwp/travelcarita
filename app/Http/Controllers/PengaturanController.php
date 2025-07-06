<?php

namespace App\Http\Controllers;

use App\Models\ProfileWeb;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    //
    public function index()
    {
        $pengaturan = ProfileWeb::first();
        $sliders = Slider::get();
        return view('admin.pages.pengaturan', compact('pengaturan', 'sliders'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'deskripsi' => 'nullable|string',

        ]);

        try {
            $pengaturan = ProfileWeb::findOrFail($id);


            $pengaturan->update([
                'title' => $request->title,
                'contact' => $request->contact,
                'email' => $request->email,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    public function storeSlider(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:50',
            'subtitle' => 'required|string|max:50',
            'banner' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $slider = Slider::count();

            if($slider >= 3) {
                return redirect()->back()->with('error', 'Slider tidak boleh lebih dari 3');
            }
            // Simpan file baru
            $path = $request->file('banner')->store('galery', 'public');
            Slider::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'banner' => $path,
            ]);

            return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$th->getMessage());
        }
    }

    public function updateSlider(Request $request, $id)
{

    $request->validate([
        'title' => 'required|string|max:50',
        'subtitle' => 'required|string|max:50',
        'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    try {
        $slider = Slider::findOrFail($id);

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;

        if ($request->hasFile('banner')) {
            // Hapus banner lama jika ada
            if ($slider->banner && Storage::disk('public')->exists($slider->banner)) {
                Storage::disk('public')->delete($slider->banner);
            }

            // Simpan banner baru
            $path = $request->file('banner')->store('galery', 'public');
            $slider->banner = $path;
        }

        $slider->save();

        return redirect()->back()->with('success', 'Slider berhasil diperbarui.');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: '.$th->getMessage());
    }
}

}