@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BLUD <sup>Alpha</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboardStatus')">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
            aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseMaster" class="collapse @yield('masterShow')" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item @yield('unitKerjaStatus')" href="{{url('unitKerja')}}">Unit Kerja</a>
                <a class="collapse-item @yield('kegiatanStatus')" href="{{url('kegiatan')}}">Kegiatan</a>
                <a class="collapse-item @yield('subkegiatanStatus')" href="{{url('subkegiatan')}}">Subkegiatan</a>
                <a class="collapse-item @yield('rekeningStatus')" href="{{url('rekening')}}">Rekening</a>
                <a class="collapse-item @yield('rekananStatus')" href="{{url('rekanan')}}">Rekanan</a>
                <a class="collapse-item @yield('pejabatStatus')" href="{{url('pejabat')}}">Pejabat</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - PPD -->
    <li class="nav-item @yield('ppdStatus')">
        <a class="nav-link" href="{{url('/ppd')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>PPD</span></a>
    </li>
    <!-- Nav Item - SOPD -->
    <li class="nav-item @yield('sopdStatus')">
        <a class="nav-link" href="{{url('/sopd')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>SOPD</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/spd')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>SPD</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
@endsection