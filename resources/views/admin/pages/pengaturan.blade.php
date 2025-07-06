@extends('admin.index')

@section('title', 'Pengaturan')

@section('content')
    <!-- Page Heading -->


    <div class="row">
        <!-- DataTales Example -->
        <div class="col-md-7 mb-4">
            <div class="card mb-4 shadow">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">Profil Website</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- Gunakan PUT karena update --}}

                                <div class="form-group">
                                    <label for="title">Judul Website</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title', $pengaturan->title) }}">
                                </div>


                                <div class="form-group">
                                    <label for="contact">Kontak</label>
                                    <input type="text" name="contact" id="contact" class="form-control"
                                        value="{{ old('contact', $pengaturan->contact) }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $pengaturan->email) }}">
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $pengaturan->deskripsi) }}</textarea>
                                </div>

                                <div class="mt-4 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card mb-4 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-gray-800">Pengaturan Slider</h1>
                    <button data-toggle="modal" data-target="#createModal" href="#"
                        class="btn btn-primary d-flex justify-content-center align-items-center"
                        style="border-radius: 4px; height:50px">
                        <i class="fas fa-plus mr-2"></i> Tambah Slider
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($sliders->isNotEmpty())
                            @foreach ($sliders as $slider)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        @if ($slider->banner)
                                            <img src="{{ asset('storage/' . $slider->banner) }}" class="card-img-top"
                                                style="height: 180px; object-fit: cover;" alt="Banner {{ $slider->title }}">
                                        @else
                                            <img src="https://via.placeholder.com/300x180?text=No+Image"
                                                class="card-img-top" alt="No Image">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{ $slider->title }}</h5>
                                            <p class="card-text text-muted small">{{ $slider->subtitle }}</p>
                                        </div>

                                        {{-- Optional Footer Button --}}
                                        <div class="card-footer border-0 bg-white text-end">
                                            <button class="btn btn-sm btn-warning btn-edit" data-target="#editModal"
                                                data-toggle="modal" data-id="{{ $slider->id }}"
                                                data-title="{{ $slider->title }}" data-subtitle="{{ $slider->subtitle }}"
                                                data-banner="{{ $slider->banner }}">Edit</button>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="alert alert-info mb-0 text-center">
                                    <strong>Tidak ada banner ditemukan.</strong>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>

    </div>

    @include('admin.components.modals.pengaturan-modal')

@endsection
