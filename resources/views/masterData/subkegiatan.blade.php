@extends('layouts.layout')

@section('masterShow')
show
@endsection

@section('subkegiatanStatus')
active
@endsection

@section('content')
<!-- Modal Tambah SubKegiatan -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah SubKegiatan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah SubKegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Kegiatan</b></label>
                    <select id="kegiatan" class="form-control" name="kegiatan" required>
                        <option value="" selected disabled>Pilih Kegiatan</option>
                        @foreach($kegiatan as $unit)
                        <option value="{{$unit->id}}">{{$unit->kode}} : {{$unit->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label><b>Kode SubKegiatan</b></label>
                    <input type="text" id="kodeKegiatan" name="kodeKegiatan" class="form-control" placeholder="Kode Kegiatan" required>
                </div>
                <div class="form-group">
                    <label><b>Nama</b></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data SubKegiatan</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data SubKegiatan</h6>
                </div>
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Kegiatan</th>
                            <th>Kegiatan</th>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Kegiatan</th>
                            <th>Kegiatan</th>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($subkegiatan as $unit)
                        <tr>
                            <td>{{$unit->kode}}</td>
                            <td>{{$unit->getKegiatan->kode}} : {{$unit->getKegiatan->nama}}</td>
                            <td>{{$unit->nama}}</td>
                            <td>{{$unit->tahun}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa"><i class="fas fa-fw fa-eye"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
    @include('layouts.alert')
@endsection