@extends('user.index')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/offers_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/offers_responsive.css') }}">
@endpush
@section('title', 'Penawaran')
@section('content')
    <div class="super_container">



        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/about_background.jpg">
            </div>
            <div class="home_content">
                <div class="home_title">Penawaran Open Trip</div>
            </div>
        </div>

        <!-- Offers -->

        <div class="offers">

            <!-- Search -->

            <div class="search">
                <div class="search_inner">

                    <!-- Search Contents -->

                    <div class="fill_height no-padding container">
                        <div class="row fill_height no-margin">
                            <div class="col fill_height no-padding">

                                <!-- Search Tabs -->





                                <<!-- Search Tabs -->
                                    <div class="search_tabs_container">
                                        <div
                                            class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                                            @foreach ($jenisPaket as $index => $paket)
                                                <div class="search_tab {{ $index === 0 ? 'active' : '' }} d-flex align-items-center justify-content-lg-center justify-content-start flex-row"
                                                    data-tab="{{ $index }}">
                                                    <img src="{{ asset('images/suitcase.png') }}" alt="">
                                                    <span>{{ $paket->nama_paket }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Search Panels -->
                                    @foreach ($jenisPaket as $index => $paket)
                                        <div class="search_panel {{ $index === 0 ? 'active' : '' }}"
                                            data-panel="{{ $index }}">
                                            <form action="{{ route('penawaran') }}" method="GET"
                                                id="search_form_{{ $index + 1 }}"
                                                class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">

                                                <input type="hidden" name="id_jenis_paket" value="{{ $paket->id }}">

                                                <div class="search_item">
                                                    <div>Paket Trip</div>
                                                    <input type="text" class="destination search_input" name="nama_paket"
                                                        value="{{ request('nama_paket') }}" placeholder="Nama paket...">
                                                </div>

                                                <div class="search_item">
                                                    <div>Tanggal</div>
                                                    <input type="date" class="check_in search_input" name="tanggal"
                                                        value="{{ request('tanggal') }}">
                                                </div>

                                                <button type="submit"
                                                    class="button search_button">cari<span></span><span></span><span></span></button>
                                            </form>

                                        </div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Offers -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-1 temp_col"></div>
                    <div class="col-lg-11">
                        <!-- Offers Sorting -->
                        <div class="offers_sorting_container">
                            {{-- Form Filter & Sorting --}}
                            <form id="sortingForm" method="GET">
                                {{-- Pertahankan filter sebelumnya --}}
                                <input type="hidden" name="id_jenis_paket" value="{{ request('id_jenis_paket') }}">
                                <input type="hidden" name="nama_paket" value="{{ request('nama_paket') }}">
                                <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">

                                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by') }}">
                                <input type="hidden" name="rating" id="rating" value="{{ request('rating') }}">

                                <ul class="offers_sorting">
                                    {{-- PRICE SORT --}}
                                    <li>
                                        <span class="sorting_text">price</span>
                                        <i class="fa fa-chevron-down"></i>
                                        <ul>
                                            <li><a href="#" onclick="event.preventDefault(); setSort('');"><span>Show
                                                        all</span></a></li>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setSort('price_asc');"><span>Ascending</span></a>
                                            </li>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setSort('price_desc');"><span>Descending</span></a>
                                            </li>
                                        </ul>
                                    </li>

                                    {{-- RATING FILTER --}}
                                    <li>
                                        <span class="sorting_text">stars</span>
                                        <i class="fa fa-chevron-down"></i>
                                        <ul>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setRating('');"><span>Show
                                                        all</span></a></li>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setRating('3');"><span>3</span></a>
                                            </li>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setRating('4');"><span>4</span></a>
                                            </li>
                                            <li><a href="#"
                                                    onclick="event.preventDefault(); setRating('5');"><span>5</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </form>


                        </div>
                    </div>

                    <div class="col-lg-12">
                        <!-- Offers Grid -->
                        <div class="offers_grid">
                            @if (!$paketWisataList->isEmpty())
                                @foreach ($paketWisataList as $paket)
                                    <div class="offers_item rating_4">
                                        <div class="row">
                                            <div class="col-lg-1 temp_col"></div>
                                            <div class="col-lg-3 col-1680-4">
                                                <div class="offers_image_container">
                                                    @php
                                                        $gambar =
                                                            $paket->galeri->first()?->url_media ?? 'images/default.jpg';
                                                    @endphp
                                                    <div class="offers_image_background"
                                                        style="background-image:url('{{ asset($gambar) }}')"></div>
                                                    <div class="offer_name">
                                                        <a href="{{ route('penawaran.show', $paket->id) }}">
                                                            {{ $paket->nama_paket }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="offers_content">
                                                    <div class="offers_price">
                                                        Rp{{ number_format($paket->harga, 0, ',', '.') }}
                                                        @if ($paket->diskon)
                                                            <span>Diskon {{ $paket->diskon }}%</span>
                                                        @endif
                                                    </div>
                                                    @php
                                                        $avgRating = round($paket->testimonis->avg('rating'));
                                                        $ratingClass = 'rating_r_' . $avgRating;
                                                    @endphp

                                                    <div class="rating_r {{ $ratingClass }} offers_rating"
                                                        data-rating="{{ $avgRating }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fa{{ $i <= $avgRating ? 's' : 'r' }} fa-star text-warning"></i>
                                                        @endfor
                                                    </div>

                                                    <p class="offers_text">{{ Str::limit($paket->deskripsi, 150) }}</p>
                                                    <div class="offers_icons">
                                                        <ul class="offers_icons_list">
                                                            <li class="offers_icons_item"><img src="images/post.png"
                                                                    alt=""></li>
                                                            <li class="offers_icons_item"><img src="images/compass.png"
                                                                    alt=""></li>
                                                            <li class="offers_icons_item"><img src="images/bicycle.png"
                                                                    alt=""></li>
                                                            <li class="offers_icons_item"><img src="images/sailboat.png"
                                                                    alt=""></li>
                                                        </ul>
                                                    </div>
                                                    <div class="button book_button">
                                                        <a href="{{ route('penawaran.show', $paket->id) }}">
                                                            Lihat<span></span><span></span><span></span></a>
                                                    </div>
                                                    <div class="offer_reviews">
                                                        <div class="offer_reviews_content">
                                                            <div class="offer_reviews_title">Populer</div>
                                                            <div class="offer_reviews_subtitle">
                                                                {{ $paket->pemesanan->count() }} pemesanan</div>
                                                        </div>
                                                        <div class="offer_reviews_rating text-center">{{ $paket->testimonis->count() }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Not Found Section (di luar offers_grid agar terlihat) --}}
                    @if ($paketWisataList->isEmpty())
                        <div class="col-lg-12">
                            <div class="px-4 py-5 text-center">
                                @include('components.handle-notfound')
                            </div>
                        </div>
                    @endif

                    {{-- Pagination --}}
                    @if (!$paketWisataList->isEmpty())
                        <div class="col-lg-12 d-flex justify-content-center mt-4">
                            {{ $paketWisataList->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>



    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/Isotope/isotope.pkgd.min.js') }}"></script>

    <script src="{{ asset('plugins/parallax-js-master/parallax.min.js') }}"></script>
    <script src="{{ asset('js/offers_custom.js') }}"></script>


    <script>
        function setSort(value) {
            document.getElementById('sort_by').value = value;
            document.getElementById('sortingForm').submit();
        }

        function setRating(value) {
            document.getElementById('rating').value = value;
            document.getElementById('sortingForm').submit();
        }
    </script>
@endpush
