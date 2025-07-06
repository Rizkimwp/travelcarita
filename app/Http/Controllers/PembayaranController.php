<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    //

    public function index() {
        $pembayarans = Pembayaran::with('pemesanan')->get();
        return view('admin.pages.pembayaran', compact('pembayarans'));
    }

    public function storeDp(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'metode' => 'required|string',
            'jumlah' => 'required|numeric|min:1000',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Pembayaran::create([
            'id_pemesanan' => $request->id_pemesanan,
            'metode' => $request->metode,
            'jumlah' => $request->jumlah,
            'bukti' => $buktiPath,
            'tipe' => 'dp',
            'status_verifikasi' => 'belum',
        ]);

        return back()->with('success', 'DP berhasil disimpan.');
    }

    public function storePelunasan(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'metode' => 'required|string',
            'jumlah' => 'required|numeric|min:1000',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Pembayaran::create([
            'id_pemesanan' => $request->id_pemesanan,
            'metode' => $request->metode,
            'jumlah' => $request->jumlah,
            'bukti' => $buktiPath,
            'tipe' => 'pelunasan',
            'status_verifikasi' => 'belum',
        ]);

        return back()->with('success', 'Pelunasan berhasil disimpan.');
    }
}