@extends('user.index')
@section('title', 'Beranda')
@section('content')
    <!-- Home -->

    <div class="home">

        <!-- Home Slider -->

        <div class="home_slider_container">

            <div class="owl-carousel owl-theme home_slider">
                <!-- Slider Item -->
                @foreach ($sliders as $profile)
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background"
                            style="background-image: url('{{ asset('storage/' . $profile->banner) }}')"></div>
                        <div class="home_slider_content text-center">
                            <div class="home_slider_content_inner" data-animation-in="flipInX"
                                data-animation-out="animate-out fadeOut">
                                <h1 class="mb-5">{{ $profile->title }}</h1>
                                <h1>{{ $profile->subtitle }}</h1>
                                <div class="button home_slider_button">
                                    <div class="button_bcg"></div><a href="{{ route('penawaran') }}">jelajahi
                                        sekarang<span></span><span></span><span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Home Slider Nav - Prev -->
            <div class="home_slider_nav home_slider_prev">
                <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="33px"
                    viewBox="0 0 28 33" enable-background="new 0 0 28 33" xml:space="preserve">
                    <defs>
                        <linearGradient id='home_grad_prev'>
                            <stop offset='0%' stop-color='#fa9e1b' />
                            <stop offset='100%' stop-color='#8d4fff' />
                        </linearGradient>
                    </defs>
                    <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                         M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                         C22.545,2,26,5.541,26,9.909V23.091z" />
                    <polygon class="nav_arrow" fill="#F3F6F9"
                        points="15.044,22.222 16.377,20.888 12.374,16.885 16.377,12.882 15.044,11.55 9.708,16.885 11.04,18.219
					11.042,18.219 " />
                </svg>
            </div>

            <!-- Home Slider Nav - Next -->
            <div class="home_slider_nav home_slider_next">
                <svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="33px"
                    viewBox="0 0 28 33" enable-background="new 0 0 28 33" xml:space="preserve">
                    <defs>
                        <linearGradient id='home_grad_next'>
                            <stop offset='0%' stop-color='#fa9e1b' />
                            <stop offset='100%' stop-color='#8d4fff' />
                        </linearGradient>
                    </defs>
                    <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                        M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                        C22.545,2,26,5.541,26,9.909V23.091z" />
                    <polygon class="nav_arrow" fill="#F3F6F9"
                        points="13.044,11.551 11.71,12.885 15.714,16.888 11.71,20.891 13.044,22.224 18.379,16.888 17.048,15.554
				17.046,15.554 " />
                </svg>
            </div>

            <!-- Home Slider Dots -->

            <div class="home_slider_dots">
                <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                    <li class="home_slider_custom_dot active">
                        <div></div>01.
                    </li>
                    <li class="home_slider_custom_dot">
                        <div></div>02.
                    </li>
                    <li class="home_slider_custom_dot">
                        <div></div>03.
                    </li>
                </ul>
            </div>

        </div>

    </div>

    <!-- Search -->

    <div class="search">
        <div class="fill_height container">
            <div class="row fill_height">
                <div class="col fill_height">

                    <!-- Search Tabs -->
                    <div class="search_tabs_container">
                        <div
                            class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                            @foreach ($jenisPaket as $index => $item)
                                <div class="search_tab {{ $index === 0 ? 'active' : '' }} d-flex align-items-center justify-content-lg-center justify-content-start flex-row"
                                    data-tab="{{ $index }}">
                                    <img src="images/suitcase.png" alt=""><span>{{ $item->nama_paket }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Search Panels -->
                    @foreach ($jenisPaket as $index => $item)
                        <div class="search_panel {{ $index === 0 ? 'active' : '' }}" data-panel="{{ $index }}">
                            <form action="{{ route('penawaran') }}" id="search_form_{{ $index + 1 }}"
                                class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-center justify-content-start">
                                <input type="hidden" name="id_jenis_paket" value="{{ $item->id }}">

                                <div class="search_item">
                                    <div>Paket Trip</div>
                                    <input type="text" class="destination search_input" name="nama_paket"
                                        value="{{ request('nama_paket') }}" placeholder="Nama paket...">
                                </div>

                                <div class="search_item mx-3">
                                    <div>Tanggal</div>
                                    <input type="date" class="check_in search_input" name="tanggal"
                                        value="{{ request('tanggal') }}">
                                </div>

                                <button type="submit"
                                    class="button search_button">search<span></span><span></span><span></span></button>
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>



    <!-- Intro -->

    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="intro_title text-center">Open Trip Terlaris Pilihan Traveler</h2>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="intro_text text-center">
                        <p>Jelajahi destinasi impian bersama open trip favorit yang paling banyak dipilih oleh para
                            traveler. Nikmati pengalaman seru, hemat biaya, dan penuh kenangan tak terlupakan.</p>

                    </div>
                </div>
            </div>
            <div class="row intro_items">

                <!-- Intro Item -->
                @foreach ($bestSellers as $paket)
                    <div class="col-lg-4 intro_col">
                        <div class="intro_item">
                            <div class="intro_item_overlay"></div>
                            <div class="intro_item_background"
                                style="background-image:url('{{ asset('storage/' . $paket->galeri->first()->url_media) }}')">
                            </div>

                            <div class="intro_item_content d-flex flex-column align-items-center justify-content-center">
                                <div class="intro_date">{{ $paket->jadwal->first()->tanggal_berangkat ?? '' }}</div>

                                <div class="button intro_button">
                                    <div class="button_bcg"></div>
                                    <a href="{{ route('penawaran.show', $paket->id) }}">see
                                        more<span></span><span></span><span></span></a>
                                </div>

                                <div class="intro_center text-center">
                                    <h1>{{ $paket->nama_paket }}</h1>
                                    <div class="intro_price">From Rp{{ number_format($paket->harga, 0, ',', '.') }}</div>
                                    @php
                                        $avgRating = round($paket->testimonis->avg('rating'));
                                        $ratingClass = 'rating_r_' . $avgRating;
                                    @endphp

                                    <div class="rating {{ $ratingClass }}">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star{{ $i < $avgRating ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="small mt-2 text-white">Total dipesan: {{ $paket->pemesanan_count }} kali
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- CTA -->

    <div class="cta">

        <div class="cta_background" style="background-image:url(images/cta.jpg)"></div>

        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- CTA Slider -->

                    <div class="cta_slider_container">
                        <div class="owl-carousel owl-theme cta_slider">

                            <!-- CTA Slider Item -->
                            <div class="owl-item cta_item text-center">
                                <div class="cta_title">maldives deluxe package</div>
                                <div class="rating_r rating_r_4">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                                <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu
                                    convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus mi hendrerit
                                    nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor augue gravida lectus, et
                                    efficitur enim justo vel ligula.</p>
                                <div class="button cta_button">
                                    <div class="button_bcg"></div><a href="#">book
                                        now<span></span><span></span><span></span></a>
                                </div>
                            </div>

                            <!-- CTA Slider Item -->
                            <div class="owl-item cta_item text-center">
                                <div class="cta_title">maldives deluxe package</div>
                                <div class="rating_r rating_r_4">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                                <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu
                                    convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus mi hendrerit
                                    nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor augue gravida lectus, et
                                    efficitur enim justo vel ligula.</p>
                                <div class="button cta_button">
                                    <div class="button_bcg"></div><a href="#">book
                                        now<span></span><span></span><span></span></a>
                                </div>
                            </div>

                            <!-- CTA Slider Item -->
                            <div class="owl-item cta_item text-center">
                                <div class="cta_title">maldives deluxe package</div>
                                <div class="rating_r rating_r_4">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                                <p class="cta_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu
                                    convallis tortor. Suspendisse potenti. In faucibus massa arcu, vitae cursus mi hendrerit
                                    nec. Proin bibendum, augue faucibus tincidunt ultrices, tortor augue gravida lectus, et
                                    efficitur enim justo vel ligula.</p>
                                <div class="button cta_button">
                                    <div class="button_bcg"></div><a href="#">book
                                        now<span></span><span></span><span></span></a>
                                </div>
                            </div>

                        </div>

                        <!-- CTA Slider Nav - Prev -->
                        <div class="cta_slider_nav cta_slider_prev">
                            <svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="33px"
                                viewBox="0 0 28 33" enable-background="new 0 0 28 33" xml:space="preserve">
                                <defs>
                                    <linearGradient id='cta_grad_prev'>
                                        <stop offset='0%' stop-color='#fa9e1b' />
                                        <stop offset='100%' stop-color='#8d4fff' />
                                    </linearGradient>
                                </defs>
                                <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                            M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                            C22.545,2,26,5.541,26,9.909V23.091z" />
                                <polygon class="nav_arrow" fill="#F3F6F9"
                                    points="15.044,22.222 16.377,20.888 12.374,16.885 16.377,12.882 15.044,11.55 9.708,16.885 11.04,18.219
								11.042,18.219 " />
                            </svg>
                        </div>

                        <!-- CTA Slider Nav - Next -->
                        <div class="cta_slider_nav cta_slider_next">
                            <svg version="1.1" id="Layer_5" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="33px"
                                viewBox="0 0 28 33" enable-background="new 0 0 28 33" xml:space="preserve">
                                <defs>
                                    <linearGradient id='cta_grad_next'>
                                        <stop offset='0%' stop-color='#fa9e1b' />
                                        <stop offset='100%' stop-color='#8d4fff' />
                                    </linearGradient>
                                </defs>
                                <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
                           M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
                           C22.545,2,26,5.541,26,9.909V23.091z" />
                                <polygon class="nav_arrow" fill="#F3F6F9"
                                    points="13.044,11.551 11.71,12.885 15.714,16.888 11.71,20.891 13.044,22.224 18.379,16.888 17.048,15.554
							17.046,15.554 " />
                            </svg>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Offers -->

    <div class="offers">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="section_title">the best offers with rooms</h2>
                </div>
            </div>
            <div class="row offers_items">

                <!-- Offers Item -->
                <div class="col-lg-6 offers_col">
                    <div class="offers_item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="offers_image_container">
                                    <!-- Image by https://unsplash.com/@kensuarez -->
                                    <div class="offers_image_background" style="background-image:url(images/offer_1.jpg)">
                                    </div>
                                    <div class="offer_name"><a href="#">grand castle</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="offers_content">
                                    <div class="offers_price">$70<span>per night</span></div>
                                    <div class="rating_r rating_r_4 offers_rating">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="offers_text">Suspendisse potenti. In faucibus massa. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Nullam eu convallis tortor.</p>
                                    <div class="offers_icons">
                                        <ul class="offers_icons_list">
                                            <li class="offers_icons_item"><img src="images/post.png" alt=""></li>
                                            <li class="offers_icons_item"><img src="images/compass.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/bicycle.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/sailboat.png" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="offers_link"><a href="offers.html">read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offers Item -->
                <div class="col-lg-6 offers_col">
                    <div class="offers_item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="offers_image_container">
                                    <!-- Image by Egzon Bytyqi -->
                                    <div class="offers_image_background" style="background-image:url(images/offer_2.jpg)">
                                    </div>
                                    <div class="offer_name"><a href="#">turkey hills</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="offers_content">
                                    <div class="offers_price">$50<span>per night</span></div>
                                    <div class="rating_r rating_r_4 offers_rating">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="offers_text">Suspendisse potenti. In faucibus massa. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Nullam eu convallis tortor.</p>
                                    <div class="offers_icons">
                                        <ul class="offers_icons_list">
                                            <li class="offers_icons_item"><img src="images/post.png" alt=""></li>
                                            <li class="offers_icons_item"><img src="images/compass.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/bicycle.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/sailboat.png" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="offers_link"><a href="offers.html">read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offers Item -->
                <div class="col-lg-6 offers_col">
                    <div class="offers_item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="offers_image_container">
                                    <!-- Image by https://unsplash.com/@nevenkrcmarek -->
                                    <div class="offers_image_background" style="background-image:url(images/offer_3.jpg)">
                                    </div>
                                    <div class="offer_name"><a href="#">island dream</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="offers_content">
                                    <div class="offers_price">$90<span>per night</span></div>
                                    <div class="rating_r rating_r_4 offers_rating">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="offers_text">Suspendisse potenti. In faucibus massa. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Nullam eu convallis tortor.</p>
                                    <div class="offers_icons">
                                        <ul class="offers_icons_list">
                                            <li class="offers_icons_item"><img src="images/post.png" alt=""></li>
                                            <li class="offers_icons_item"><img src="images/compass.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/bicycle.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/sailboat.png" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="offers_link"><a href="offers.html">read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offers Item -->
                <div class="col-lg-6 offers_col">
                    <div class="offers_item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="offers_image_container">
                                    <!-- Image by https://unsplash.com/@mantashesthaven -->
                                    <div class="offers_image_background" style="background-image:url(images/offer_4.jpg)">
                                    </div>
                                    <div class="offer_name"><a href="#">travel light</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="offers_content">
                                    <div class="offers_price">$30<span>per night</span></div>
                                    <div class="rating_r rating_r_4 offers_rating">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </div>
                                    <p class="offers_text">Suspendisse potenti. In faucibus massa. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Nullam eu convallis tortor.</p>
                                    <div class="offers_icons">
                                        <ul class="offers_icons_list">
                                            <li class="offers_icons_item"><img src="images/post.png" alt=""></li>
                                            <li class="offers_icons_item"><img src="images/compass.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/bicycle.png" alt="">
                                            </li>
                                            <li class="offers_icons_item"><img src="images/sailboat.png" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="offers_link"><a href="offers.html">read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <!-- Footer -->



    <!-- Copyright -->

@endsection
