@extends('admin.index')

@section('title', 'Detail Paket Wisata')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 mb-4">
        {{-- HEADER: Gambar + Info --}}
        <div class="row no-gutters">
            {{-- Gambar Utama --}}
            <div class="col-md-5">
                <img src="{{ $paketWisata->galeri->first() ? asset('storage/' . $paketWisata->galeri->first()->url_media) : asset('images/no-image.png') }}"
                    alt="Cover Paket Wisata" class="img-fluid rounded-start w-100 h-100 object-fit-cover">
            </div>

            {{-- Informasi Umum --}}
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $paketWisata->nama_paket }}</h3>
                    <h5 class="text-success">Rp{{ number_format($paketWisata->harga, 0, ',', '.') }}</h5>
                    <p class="card-text text-muted">{!! nl2br(e($paketWisata->deskripsi)) !!}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- DETAIL SECTIONS --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            {{-- Itinerari --}}
            <section class="mb-4">
                <h5 class="text-primary">🧭 Itinerari</h5>
                <ul class="list-group list-group-flush">
                    @forelse ($paketWisata->itinerari as $item)
                        <li class="list-group-item">
                            <strong>Hari {{ $item->hari_ke }}:</strong> {{ $item->kegiatan }}
                        </li>
                    @empty
                        <li class="list-group-item text-muted"><em>Belum ada itinerari.</em></li>
                    @endforelse
                </ul>
            </section>

            {{-- Fasilitas --}}
            <section class="mb-4">
                <h5 class="text-primary">🏕️ Fasilitas</h5>
                <div class="row">
                    @forelse ($paketWisata->fasilitasPaket as $fasilitasPaket)
                        <div class="col-md-4 mb-2">
                            <div class="alert alert-light border d-flex align-items-center">
                                <i class="fas fa-check-circle text-success mr-2"></i>
                                {{ $fasilitasPaket->fasilitas->nama_fasilitas ?? '-' }}
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-muted"><em>Tidak ada fasilitas.</em></div>
                    @endforelse
                </div>
            </section>

            {{-- Jadwal --}}
            <section class="mb-4">
                <h5 class="text-primary">📅 Jadwal Keberangkatan</h5>
                <ul class="list-group list-group-flush">
                    @forelse ($paketWisata->jadwal as $jadwal)
                        <li class="list-group-item">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->translatedFormat('d F Y') }}
                        </li>
                    @empty
                        <li class="list-group-item text-muted"><em>Tidak ada jadwal keberangkatan.</em></li>
                    @endforelse
                </ul>
            </section>

            {{-- Galeri Tambahan --}}
            @if ($paketWisata->galeri->count() > 1)
                <section class="mb-4">
                    <h5 class="text-primary">🖼️ Galeri</h5>
                    <div class="row">
                        @foreach ($paketWisata->galeri->skip(1) as $gambar)
                            <div class="col-md-3 mb-3">
                                <div class="border rounded shadow-sm">
                                    <img src="{{ asset('storage/' . $gambar->url_media) }}"
                                        class="img-fluid rounded" alt="Galeri Tambahan">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- FAQ --}}
            <section class="mb-4">
                <h5 class="text-primary">❓ FAQ</h5>
                <div class="accordion" id="faqAccordion">
                    @forelse ($paketWisata->faqs as $faq)
                        <div class="card mb-2">
                            <div class="card-header p-2" id="heading{{ $loop->index }}">
                                <h6 class="mb-0">
                                    <button class="btn btn-link text-left w-100" type="button"
                                        data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                                        aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse{{ $loop->index }}" class="collapse"
                                aria-labelledby="heading{{ $loop->index }}"
                                data-parent="#faqAccordion">
                                <div class="card-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted"><em>Belum ada FAQ.</em></p>
                    @endforelse
                </div>
            </section>

            {{-- Maps --}}
            <section>
                <h5 class="text-primary">🗺️ Lokasi</h5>
                @if ($paketWisata->maps)
                    <div class="embed-responsive embed-responsive-16by9 border rounded shadow-sm">
                        {!! $paketWisata->maps->first()->path !!}
                    </div>
                @else
                    <p class="text-muted"><em>Lokasi tidak tersedia.</em></p>
                @endif
            </section>
        </div>
    </div>

    <a href="{{ route('paketwisata.index') }}" class="btn btn-secondary">
        ← Kembali ke Daftar Paket
    </a>
</div>
@endsection
