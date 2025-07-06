@extends('admin.index')

@section('title', 'Paket Wisata')

@section('content')
    <!-- Page Heading -->



    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Paket Wisata</h1>
            <a href="{{ route('paketwisata.create') }}"
                class="btn btn-primary d-flex justify-content-center align-items-center"
                style="border-radius: 4px; height:50px">
                <i class="fas fa-plus mr-2"></i> Tambah Paket Wisata
            </a>
        </div>
        <div class="card-body">
            <!-- Toolbar atas -->
            <div class="d-flex align-items-center mb-3">
                <!-- Dropdown Limit -->
                <div class="d-flex align-items-center mr-4">
                    <label class="mb-0 mr-2">Show:</label>
                    <select class="form-control w-auto" onchange="window.location.href='?limit='+this.value">
                        <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15</option>
                    </select>
                </div>

                <!-- Form Pencarian -->
                <form action="{{ route('user') }}" method="GET" class="form-inline ml-auto">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama user..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                @if ($paketWisata->isNotEmpty())
                    @foreach ($paketWisata as $data)
                        @php
                            $firstGaleri = $data->galeri->first();
                            $imageUrl = $firstGaleri
                                ? asset('storage/' . $firstGaleri->url_media)
                                : 'https://via.placeholder.com/300x180?text=No+Image';
                            $imageAlt = $firstGaleri ? 'Banner ' . $data->nama_paket : 'No Image';
                        @endphp

                        <div class="col-md-3 col-lg-3 d-flex mb-4">
                            <div class="card h-100 w-100 border-0 shadow-sm">
                                <img src="{{ $imageUrl }}" loading="lazy" class="card-img-top"
                                    style="height: 180px; object-fit: cover;" alt="{{ $imageAlt }}">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate mb-1" title="{{ $data->nama_paket }}">
                                        {{ $data->nama_paket }}
                                    </h5>
                                    <p class="card-text text-muted small text-truncate-2"
                                        style="line-height: 1.4em; max-height: 2.8em; overflow: hidden;"
                                        title="{{ $data->deskripsi }}">
                                        {{ $data->deskripsi }}
                                    </p>
                                    <div class="mt-auto text-end">
                                        <a href="{{ route('paketwisata.edit', $data->id) }}" class="btn btn-sm btn-primary"
                                            title="Edit Paket Wisata">
                                            <i class="fa fa-pencil-alt"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $data->id }}"
                                            data-name="{{ $data->nama_paket }}" title="Hapus Paket Wisata">
                                            <i class="fa fa-trash"></i> Hapus
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @include('components.handle-notfound')
                @endif
            </div>


            <!-- Pagination + Dropdown bawah -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                {{ $paketWisata->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>


    @include('admin.components.modals.paket-modal')



@endsection
