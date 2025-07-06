<?php

namespace App\Providers;

use App\Models\Pemesanan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class HomeProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Bagikan profile (pengaturan) ke semua view
        View::composer('*', function ($view) { // ambil profile pertama
            $authCheck = Auth::check();
            $authUser = Auth::user();
            $cartCount = $authCheck ? Pemesanan::where('id_user', $authUser->id)->where('status_pembayaran', 'belum')->count() : 0;
            $view->with([
                'authCheck' => $authCheck,
                'authUser' => $authUser,
                'cartCount' => $cartCount,
            ]);
        });
    }

    public function register(): void
    {
        //
    }
}