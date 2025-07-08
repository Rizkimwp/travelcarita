@extends('user.index')
@push('styles')
    <link href="{{ asset('plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_listing_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_listing_responsive.css') }}">
@endpush
@section('title', 'Detail Penawaran')
@section('content')

    <div class="super_container">

        <!-- Header -->


        <!-- Home -->

        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll"
                data-image-src="{{ asset('images/single_background.jpg') }}"></div>
            <div class="home_content">
                <div class="home_title">detail wisata</div>
            </div>
        </div>

        <!-- Offers -->

        <div class="listing">

            <!-- Search -->



            <!-- Single Listing -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single_listing">

                            {{-- ========== INFO UTAMA ========== --}}
                            <div class="hotel_info">
                                <div class="hotel_title_container d-flex flex-lg-row flex-column">
                                    <div class="hotel_title_content">
                                        <h1 class="hotel_title">{{ $paketWisata->nama_paket }}</h1>
                                        <div
                                            class="rating_r rating_r_{{ round($paketWisata->testimonis->avg('rating') ?? 0) }} hotel_rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="{{ $i <= round($paketWisata->testimonis->avg('rating') ?? 0) ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="hotel_location">
                                            {{ optional($paketWisata->maps->first())->alamat ?? 'Alamat tidak tersedia' }}
                                        </div>
                                    </div>
                                    <div
                                        class="hotel_title_button ml-lg-auto text-lg-right d-flex align-items-center gap-2">

                                        {{-- Tombol Masukkan ke Keranjang (ikon saja) --}}
                                        {{-- Tombol Pesan Sekarang --}}
                                        <div class="button book_button trans_200 mr-1">
                                            <a href="#">Pesan Sekarang<span></span><span></span><span></span></a>
                                        </div>

                                        <form action="{{ route('keranjang.store') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="id_paket" value="{{ $paketWisata->id }}">
                                            <button type="submit"
                                            class="btn btn-warning btn-lg  rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;" title="Masukkan ke Keranjang">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        </form>


                                    </div>

                                </div>

                                {{-- ========== GAMBAR UTAMA ========== --}}
                                <div class="hotel_image">
                                    <img src="{{ asset($paketWisata->galeri->first()->url_media ?? 'images/default.jpg') }}"
                                        alt="">
                                    <div
                                        class="hotel_review_container d-flex flex-column align-items-center justify-content-center">
                                        <div class="hotel_review">
                                            <div class="hotel_review_content">
                                                <div class="hotel_review_title">Rating</div>
                                                <div class="hotel_review_subtitle">{{ $paketWisata->testimonis->count() }}
                                                    Ulasan</div>
                                            </div>
                                            <div class="hotel_review_rating text-center">
                                                {{ number_format($paketWisata->testimonis->avg('rating') ?? 0, 1) }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ========== GALERI ========== --}}
                                <div class="hotel_gallery mb-5">
                                    <div class="owl-carousel owl-theme hotel_slider">
                                        @foreach ($paketWisata->galeri as $item)
                                            <div class="owl-item">
                                                <a class="colorbox" href="{{ asset($item->url_media) }}">
                                                    <img src="{{ asset($item->url_media) }}" alt="Galeri">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                {{-- ========== DESKRIPSI ========== --}}
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Deskripsi Paket Wisata
                                </h4>
                                <div class="hotel_info_text">
                                    <p>{{ $paketWisata->deskripsi }}</p>
                                </div>

                                {{-- ========== FASILITAS ========== --}}
                                <div class="hotel_info_tags mb-4">
                                    <h4
                                        style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                        Fasilitas yang Disediakan dalam Paket Ini
                                    </h4>

                                    <ul class="hotel_icons_list d-flex mt-3 flex-wrap gap-3 ps-0">
                                        @forelse ($paketWisata->fasilitasPaket as $fasilitas)
                                            <li class="hotel_icons_item d-flex flex-column align-items-center text-center"
                                                style="width: 100px;">
                                                <div
                                                    style="width: 48px; height: 48px; background-color: #f1f1f1; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 6px;">
                                                    <img src="{{ asset('images/' . ($fasilitas->fasilitas->ikon ?? 'post.png')) }}"
                                                        alt="ikon" style="max-width: 60%; max-height: 60%;">
                                                </div>
                                                <small style="font-size: 0.85rem; color: #333;">
                                                    {{ $fasilitas->fasilitas->nama_fasilitas }}
                                                </small>
                                            </li>
                                        @empty
                                            <li class="text-muted">Tidak ada fasilitas.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            {{-- ========== ITINERARI ========== --}}
                            <div class="mb-3">
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Itinerari Perjalanan
                                </h4>
                                <ul class="list-group mt-3">
                                    @forelse ($paketWisata->itinerari as $itinerari)
                                        <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                            <div>
                                                <strong>Hari ke-{{ $itinerari->hari_ke }}:</strong>
                                                {{ $itinerari->kegiatan }}
                                            </div>
                                            @if ($itinerari->waktu)
                                                <div class="text-muted">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $itinerari->waktu }}
                                                </div>
                                            @endif
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">Belum ada itinerari.</li>
                                    @endforelse
                                </ul>
                            </div>


                            {{-- ========== JADWAL ========== --}}
                            <div class="rooms mb-5">
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Jadwal Keberangkatan
                                </h4>
                                @forelse ($paketWisata->jadwal as $jadwal)
                                    <div class="room mb-3">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="room_content">
                                                    <div class="room_title">{{ $jadwal->judul }}</div>
                                                    <div class="room_text">
                                                        {{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->translatedFormat('d F Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($jadwal->tanggal_selesai)->translatedFormat('d F Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Belum ada jadwal keberangkatan.</p>
                                @endforelse
                            </div>

                            {{-- ========== FAQ ========== --}}
                            <div class="mb-5">
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Pertanyaan yang sering ditanyakan (FAQS)
                                </h4>
                                <div class="accordion" id="faqAccordion">
                                    @forelse ($paketWisata->faqs as $index => $faq)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $index }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link {{ $index > 0 ? 'collapsed' : '' }}"
                                                        data-toggle="collapse" data-target="#collapse{{ $index }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $index }}">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse{{ $index }}"
                                                class="{{ $index == 0 ? 'show' : '' }} collapse"
                                                aria-labelledby="heading{{ $index }}" data-parent="#faqAccordion">
                                                <div class="card-body">{{ $faq->answer }}</div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">Belum ada FAQ tersedia.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- ========== TESTIMONI ========== --}}
                            <div class="reviews mb-5">
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Testimoni Pelanggan
                                </h4>
                                <div class="reviews_container">
                                    @forelse ($paketWisata->testimonis as $review)
                                        <div class="review mb-3">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <div class="review_image">
                                                        <img src="{{ asset('images/review_default.jpg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-11">
                                                    <div class="review_content">
                                                        <div class="review_title_container">
                                                            <div class="review_title">{{ $review->judul }}</div>
                                                            <div class="review_rating">{{ $review->rating }}</div>
                                                        </div>
                                                        <div class="review_text">
                                                            <p>{{ $review->isi }}</p>
                                                        </div>
                                                        <div class="review_name">{{ $review->nama }}</div>
                                                        <div class="review_date">
                                                            {{ $review->created_at->translatedFormat('d F Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">Belum ada testimoni.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="location_on_map">
                                <h4
                                    style="font-weight: 600; font-size: 1.5rem; color: #2c3e50; border-bottom: 2px solid #fa9e1b; padding-bottom: 6px;">
                                    Lokasi Wisata
                                </h4>
                                <div class="travelix_map">
                                    <div id="google_map" class="google_map">
                                        <div class="map_container">
                                            <div id="map">
                                                {!! $paketWisata->maps->first()->path ?? '<p class="text-muted">Peta tidak tersedia.</p>' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>




    </div>

@endsection

@push('scripts')
    <script src="{{ asset('plugins/parallax-js-master/parallax.min.js') }}"></script>
    <script src="{{ asset('plugins/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="{{ asset('js/single_listing_custom.js') }}"></script>
@endpush
