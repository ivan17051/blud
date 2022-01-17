@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                </div>
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transaksitable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >ID</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                            <th >Tanggalref</th>
                            <th >Idgrup</th>
                            <th >Idunitkerja</th>
                            <th >Idrekening</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th >ID</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                            <th >Tanggalref</th>
                            <th >Idgrup</th>
                            <th >Idunitkerja</th>
                            <th >Idrekening</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
@include('layouts.alert')
<script type="text/javascript">
$(document).ready(function(){
    oTable = $("#transaksitable").dataTable({
        processing: false,
        serverSide: true,
        ajax: {url: '{{route("transaksi.data")}}'},
        columns: [
            { data:'id' },
            { data:'tipe' },
            { data: 'tanggalref'},
            { data: 'subkegiatan.nama'},
            { data: 'rekening.nama'},
            { data: 'jenis'},
            { data: 'jumlah'},
            { data: 'action', orderable: false, searchable: false, width: 1 },
            { data: 'tanggal'},
            { data: 'idgrup'},
            { data: 'idunitkerja'},
            { data: 'idrekening'}
        ],
    });
});
</script>
@endsection