<?php

namespace App\Http\Controllers;

use App\Models\ProfileWeb;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    //

    public function index() {
        $sliders = Slider::get();
        return view('user.pages.home', compact('sliders'));
    }
}