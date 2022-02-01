@extends('layouts.layout')

@section('dashboardStatus')
active
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Card Anggaran x Realisasi -->
        @foreach($subkegiatan as $sk)
        @php 
            $anggaran=rand(5000000,20000000); 
            $percentage=rand(10,100); 
            $realisasi=intval($anggaran*$percentage/100); 
        @endphp
        <div class="col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{$sk->kode." - ".strtoupper($sk->nama)}}</div>
                                <h4
                                class="text-xs text-primary mb-1">{{number_format($realisasi,0,',','.').' / '.number_format($anggaran,0,',','.')}}</h4>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$percentage}}%"
                                    aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection