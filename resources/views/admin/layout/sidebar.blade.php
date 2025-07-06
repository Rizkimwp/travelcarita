<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Carita Trip</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Heading -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Master
    </div>
    <!-- Divider -->

    <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-user-astronaut"></i>
            <span>User</span>
        </a>
    </li>


    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Fitur
    </div>

    <li class="nav-item {{ Request::is('paket-wisata*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-plane-arrival"></i>
            <span>Tour & Travel</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded bg-white py-2">
                <h6 class="collapse-header">Master Tour & Travel</h6>

                <a class="collapse-item" href="{{ route('jeniswisata.index') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Jenis Wisata </span>
                </a>

                <a class="collapse-item" href="{{ route('fasilitas.index') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Fasilitas Wisata </span>
                </a>
                <a class="collapse-item" href="{{ route('paketwisata.index') }}">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Paket Wisata</span>
                </a>
                <a class="collapse-item" href="{{ route('layanan.index') }}">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Layanan Fasilitas</span>
                </a>



            </div>
        </div>
    </li>



    <li class="nav-item {{ Request::is('pemesanan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pemesanan.index') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Pemesanan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pembayaran</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>Testimoni</span>
        </a>
    </li>


    <!-- Divider -->

    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Profile
    </div>

    <li class="nav-item {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengaturan.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="d-none d-md-inline text-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
