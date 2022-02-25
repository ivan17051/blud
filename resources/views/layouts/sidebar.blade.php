@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
@php
$user = Auth::user()->role;
@endphp
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
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
    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item @yield('masterShow')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
            aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseMaster" class="collapse @yield('masterShow')" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                @if($user=='admin')
                <a class="collapse-item @yield('userStatus')" href="{{url('user')}}">User</a>
                @endif
                @if(in_array($user, array('admin', 'KEU')))
                <a class="collapse-item @yield('unitKerjaStatus')" href="{{url('unitKerja')}}">Unit Kerja</a>
                <a class="collapse-item @yield('kegiatanStatus')" href="{{url('kegiatan')}}">Kegiatan</a>
                <a class="collapse-item @yield('subkegiatanStatus')" href="{{url('subkegiatan')}}">Subkegiatan</a>
                <a class="collapse-item @yield('rekeningStatus')" href="{{url('rekening')}}">Rekening</a>
                <a class="collapse-item @yield('pajakStatus')" href="{{url('pajak')}}">Pajak</a>
                @endif
                @if(in_array($user, array('admin', 'PKM', 'KEU')))
                <a class="collapse-item @yield('rekananStatus')" href="{{url('rekanan')}}">Rekanan</a>
                <a class="collapse-item @yield('pejabatStatus')" href="{{url('pejabat')}}">Pejabat</a>
                @endif
                @if(in_array($user, array('admin', 'PIH')))
                <a class="collapse-item @yield('saldoStatus')" href="{{url('saldo')}}">Saldo</a>
                @endif
            </div>
        </div>
    </li>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Transaksi
    </div> -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('spjStatus')">
        <a class="nav-link" href="{{url('/spj')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>SPJ</span></a>
    </li>

    <!-- Nav Item - Transaksi -->
    <li class="nav-item @yield('transaksiStatus')">
        <a class="nav-link" href="{{url('/transaksi')}}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>SPP-SPM</span></a>
    </li>
    <!-- Nav Item - BKU -->
    <li class="nav-item @yield('bkuStatus')">
        <a class="nav-link" href="{{url('/bku')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>BKU</span></a>
    </li>
    <!-- Nav Item - LPJ -->
    <li class="nav-item @yield('lpjStatus')">
        <a class="nav-link" href="{{url('/lpj')}}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>LPJ</span></a>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-table"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse " aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <div class="dropdown c-dropdown-right" >
                    <a class="collapse-item dropdown-toggle" href="#" id="dropdownFungsional" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fungsional</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <a class="dropdown-item" href="#">per Rekening</a>
                    </div>
                </div>
            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - LPJ -->
    <li class="nav-item @yield('bukuBankStatus')">
        <a class="nav-link" href="{{url('/bukuBank')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Buku Bank</span></a>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- SAMPLE DROPDOWN MENU -->
    <li class="nav-item">
        <div class="dropdown auto-hover">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownLaporan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownLaporan">
                <!-- <a class="dropdown-item" href="#">per Rekening</a> -->
                <!-- <a class="dropdown-item" href="#">Another action</a> -->
                <div class="dropdown auto-hover c-dropdown-right"  >
                    <a class="dropdown-item dropdown-toggle" href="#" id="dropdownLaporanPertanggungjawaban" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pertanggungjawaban</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownLaporanPertanggungjawaban">
                        <a class="dropdown-item" href="#" onclick="my.openModalView('{{route('fungsional')}}', 'laporanFungsional')" >Fungsional</a>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
@endsection