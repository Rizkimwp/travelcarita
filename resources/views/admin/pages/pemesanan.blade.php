@extends('admin.index')

@section('title', 'Data Pemesanan')

@section('content')




    <!-- DataTales Example -->
    <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Data Pemesanan</h1>
            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary d-flex justify-content-center align-items-center"
                style="border-radius: 4px; height:50px">
                <i class="fas fa-plus mr-2"></i> Buat Pemesanan
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
                <form action="{{ route('pemesanan.index') }}" method="GET" class="form-inline ml-auto">
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
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Pemesan</th>
                            <th>Paket Wisata</th>
                            <th>Jadwal Berangkat</th>
                            <th>Jumlah Peserta</th>
                            <th>Status Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$pemesanan->isEmpty())
                            @foreach ($pemesanan as $item)
                                <tr>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>
                                        {{ $item->paket->nama_paket ?? '-' }} <br>
                                        @if ($item->id_paket)
                                            <a href="{{ route('paketwisata.show', $item->id_paket) }}" class="btn btn-sm btn-outline-primary mt-1">
                                                🔍 View Detail
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $item->paket ? \Carbon\Carbon::parse($item->paket->jadwal->first()->tanggal_berangkat)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $item->jumlah_peserta }}</td>
                                    <td>
                                        <span class="badge badge-{{
                                            $item->status_pembayaran == 'lunas' ? 'success' :
                                            ($item->status_pembayaran == 'dp' ? 'info' : 'warning') }}">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    </td>
                                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="p-5 text-center">
                                    @include('components.handle-notfound')
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>




            <!-- Pagination + Dropdown bawah -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                {{ $pemesanan->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    @include('admin.components.modals.fasilitas-modal')

@endsection
