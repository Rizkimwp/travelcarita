@extends('admin.index')

@section('title', 'Master User')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus mr-1"></i> Tambah User
        </button>
    </div>



    <!-- DataTales Example -->
    <div class="card mb-4 shadow">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0">Data User</h6>
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

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table-bordered table" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Nomor Hp</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$users->isEmpty())
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td>{{ $user->phone ?? '-' }}</td>
                                    <td>{{ $user->role ?? '-' }}</td>
                                    <td>
                                        <x-action-dropdown :item-id="$user->id" :item-name="$user->name" :item-email="$user->email"
                                            :item-phone="$user->phone" :item-role="$user->role" />
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="p-5 text-center">
                                    @include('components.handle-notfound')
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination + Dropdown bawah -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>


    @include('admin.components.modals.user-modal')

@endsection
