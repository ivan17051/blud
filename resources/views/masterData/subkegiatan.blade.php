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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah SubKegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subkegiatan.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><b>Kegiatan</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idkegiatan" required >
                            <option value="" selected disabled>Pilih Kegiatan</option>
                            @foreach($kegiatan as $unit)
                            <option value="{{$unit->id}}">{{$unit->kode}} : {{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><b>Kelompok Subkegiatan</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idgrup">
                            <option value="" selected>Pilih SubKegiatan</option>
                            @foreach($grupSubkeg as $unit)
                            <option value="{{$unit->idgrup}}">{{$unit->kode}} : {{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label><b>Kode SubKegiatan</b></label>
                        <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode Kegiatan" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><b>Tanggal</b></label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label><b>Penanggung Jawab</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idpejabat" required >
                            <option value="" selected disabled>Pilih Penanggung Jawab</option>
                            @foreach($pejabat as $unit)
                            <option value="{{$unit->id}}">{{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Nama Subkegiatan</b></label>
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

<!-- Modal Sunting Kegiatan -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting SubKegiatan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sunting SubKegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subkegiatan.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><b>Kegiatan</b></label>
                        <input type="hidden" name="idkegiatan">
                        <select id="idkegiatan" class="form-control" name="idkegiatan" required disabled>
                            <option value="" selected disabled>Pilih Kegiatan</option>
                            @foreach($kegiatan as $unit)
                            <option value="{{$unit->id}}">{{$unit->kode}} : {{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><b>Kelompok Subkegiatan</b></label>
                        <input type="hidden" name="idgrup">
                        <select id="idgrup" class="form-control" name="idgrup" disabled>
                            <option value="" selected>Pilih SubKegiatan</option>
                            @foreach($grupSubkeg as $unit)
                            <option value="{{$unit->idgrup}}">{{$unit->kode}} : {{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label><b>Kode SubKegiatan</b></label>
                        <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode Kegiatan" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><b>Tanggal</b></label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label><b>Penanggung Jawab</b></label>
                        <select id="idpejabat" class="form-control" name="idpejabat" required>
                            <option value="" selected disabled>Pilih Penanggung Jawab</option>
                            @foreach($pejabat as $unit)
                            <option value="{{$unit->id}}">{{$unit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Nama Subkegiatan</b></label>
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

<!-- Hapus -->
<form hidden action="{{route('subkegiatan.delete')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data SubKegiatan</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

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
                            <th hidden>ID</th>
                            <th hidden>ID Grup</th>
                            <th hidden>ID Pejabat</th>
                            <th hidden>ID Kegiatan</th>
                            <th>Kode SubKegiatan</th>
                            <th>Kegiatan</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th hidden>ID</th>
                            <th hidden>ID Grup</th>
                            <th hidden>ID Pejabat</th>
                            <th hidden>ID Kegiatan</th>
                            <th>Kode SubKegiatan</th>
                            <th>Kegiatan</th>
                            <th>Nama SubKegiatan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($subkegiatan as $unit)
                        <tr>
                            <td hidden>{{$unit->id}}</td>
                            <td hidden>{{$unit->idgrup}}</td>
                            <td hidden>{{$unit->idpejabat}}</td>
                            <td hidden>{{$unit->idkegiatan}}</td>
                            <td>{{$unit->kode}}</td>
                            <td>{{$unit->getKegiatan->kode}} : {{$unit->getKegiatan->nama}}</td>
                            <td>{{$unit->nama}}</td>
                            <td>{{$unit->tanggal}}</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                                <button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>
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
<script>
function edit(self){
    var $modal=$('#sunting');
    var tr = $(self).closest('tr');
    var data=oTable.row(tr).data().reduce(function(res,val,i){
        res[oTable.cols[i]]=val;
        return res;
    },{});
    console.log(data);
    $modal.find('input[name=id]').val(data['ID']);
    $modal.find('select[name=idgrup]').val(data['ID Grup']).change();
    $modal.find('input[name=idgrup]').val(data['ID Grup']);
    $modal.find('select[name=idkegiatan]').val(data['ID Kegiatan']).change();
    $modal.find('input[name=idkegiatan]').val(data['ID Kegiatan']);
    $modal.find('select[name=idpejabat]').val(data['ID Pejabat']).change();
    $modal.find('input[name=kode]').val(data['Kode SubKegiatan']);
    $modal.find('input[name=nama]').val(data['Nama']);
    $modal.find('input[name=tanggal]').val(data['Tanggal']);
}

function hapus(self){
    var tr = $(self).closest('tr');
    var data=oTable.row(tr).data().reduce(function(res,val,i){
        res[oTable.cols[i]]=val;
        return res;
    },{});
    $('#delete').find('input[name=id]').val(data['ID']);
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin menghapus?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#delete').submit();
        }
    })
}
</script>
@endsection