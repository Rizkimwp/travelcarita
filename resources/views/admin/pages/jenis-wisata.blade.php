@extends('admin.index')

@section('title', 'Jenis Paket Wisata')

@section('content')




<!-- DataTales Example -->
<div class="card mb-4 shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Jenis Paket Wisata</h1>
        <button data-toggle="modal" data-target="#createModal" href="#"
            class="btn btn-primary d-flex justify-content-center align-items-center"
            style="border-radius: 4px; height:50px">
            <i class="fas fa-plus mr-2"></i> Tambah Jenis Paket
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
            <form action="{{ route('jeniswisata.index') }}" method="GET" class="form-inline ml-auto">
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
            <table class="table-bordered table" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$jenisPaket->isEmpty())
                        @foreach ($jenisPaket as $item)
                            <tr>
                                <td>{{ $item->nama_paket }}</td>

                                <td>
                                    <x-action-dropdown :item-id="$item->id" :item-name="$item->nama_paket"  />
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="p-5 text-center">
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

            {{ $jenisPaket->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

    @include('admin.components.modals.jeniswisata-modal')

@endsection
