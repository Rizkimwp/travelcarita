<?php

namespace App\Http\Controllers;

use App\Models\JenisPaket;
use App\Models\PaketWisata;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyProfileController extends Controller
{
    //

    public function home()
    {
        $sliders = Slider::get();
        $jenisPaket = JenisPaket::get();
        $bestSellers = PaketWisata::withCount('pemesanan')
            ->orderByDesc('pemesanan_count')
            ->take(3)
            ->get();

        return view('user.pages.home', compact('sliders', 'jenisPaket', 'bestSellers'));
    }

    public function offer(Request $request)
    {
        $jenisPaket = JenisPaket::get();

        $query = PaketWisata::with(['galeri', 'testimonis']);

        if ($request->filled('id_jenis_paket')) {
            $query->where('id_jenis_paket', $request->id_jenis_paket);
        }

        if ($request->filled('nama_paket')) {
            $query->where('nama_paket', 'like', '%'.$request->nama_paket.'%');
        }

        if ($request->filled('tanggal')) {
            $tanggal = $request->tanggal;
            $query->whereHas('jadwal', function ($q) use ($tanggal) {
                $q->whereDate('tanggal_mulai', '<=', $tanggal)
                    ->whereDate('tanggal_selesai', '>=', $tanggal);
            });
        }

        // Filter rating (misalnya berdasarkan relasi testimonis)
        if ($request->filled('rating')) {
            $query->whereHas('testimonis', function ($q) use ($request) {
                $q->havingRaw('ROUND(AVG(rating)) = ?', [(int) $request->rating]);
            });
        }

        // Urutkan berdasarkan harga atau rating
        if ($request->filled('sort_by')) {
            if ($request->sort_by === 'price_asc') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort_by === 'price_desc') {
                $query->orderBy('harga', 'desc');
            } elseif ($request->sort_by === 'rating_desc') {
                // misal bintang = rata-rata rating dari testimonis
                $query->withAvg('testimonis', 'rating')->orderBy('testimonis_avg_rating', 'desc');
            }
        }

        $paketWisataList = $query->paginate(6)->appends($request->query());

        return view('user.pages.offers', compact('jenisPaket', 'paketWisataList'));
    }


    public function showOffer($id)
    {
        try {
            $paketWisata = PaketWisata::with(['jadwal', 'itinerari', 'fasilitasPaket.fasilitas', 'galeri', 'faqs', 'maps', 'testimonis'])
                ->findOrFail($id);

            return view('user.pages.show-offers', compact('paketWisata'));
        } catch (\Exception $e) {
            Log::error('View PaketWisata failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data paket wisata.');
        }
    }
}