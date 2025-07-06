@extends('admin.index')

@section('title', 'Layanan Fasilitas')

@section('content')




    <!-- DataTales Example -->
    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Layanan Fasilitas</h1>
            <button data-toggle="modal" data-target="#createModal" href="#"
                class="btn btn-primary d-flex justify-content-center align-items-center"
                style="border-radius: 4px; height:50px">
                <i class="fas fa-plus mr-2"></i> Tambah Layanan
            </button>
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
                <form action="{{ route('fasilitas.index') }}" method="GET" class="form-inline ml-auto">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama user..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table-bordered table-striped table" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Fasilitas</th>
                            <th>Judul Layanan</th>
                            <th>Harga / Jam</th>


                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($layanan->isNotEmpty())
                            @foreach ($layanan as $item)
                                <tr>
                                    <td>{{ $item->fasilitas->nama_fasilitas ?? '-' }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <x-action-dropdown :item-id="$item->id" :item-name="$item->title" />
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="p-5 text-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center"
                                        style="min-height: 200px;">
                                        <div id="lottie-animation" style="width: 200px; height: 200px;"></div>
                                        <p class="text-muted mb-0 mt-3">Data Tidak Ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>


            <!-- Pagination + Dropdown bawah -->
            <div class="d-flex justify-content-between align-items-center mt-3">

            {{ $layanan->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    @include('admin.components.modals.layanan-modal')

@endsection
