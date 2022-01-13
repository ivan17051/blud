@extends('layouts.layout')

@section('masterShow')
show
@endsection

@section('pejabatStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Pejabat -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Rekanan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Pejabat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pejabat.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Nama</b></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label><b>NIK</b></label>
                    <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" required>
                </div>
                <div class="form-group">
                    <label><b>NIP</b></label>
                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" required>
                </div>
                <div class="form-group">
                    <label><b>Golongan</b></label>
                    <input type="text" id="golongan" name="golongan" class="form-control" placeholder="Golongan" >
                </div>
                <div class="form-group">
                    <label><b>Jabatan</b></label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" >
                </div>
                <div class="form-group">
                    <label><b>Rekening</b></label>
                    <input type="text" id="rekening" name="rekening" class="form-control" placeholder="Rekening" >
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

<!-- Modal Sunting Pejabat -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting Rekanan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suntingLabel">Sunting Pejabat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pejabat.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Nama</b></label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label><b>NIK</b></label>
                    <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                </div>
                <div class="form-group">
                    <label><b>NIP</b></label>
                    <input type="text" name="nip" class="form-control" placeholder="NIP" required>
                </div>
                <div class="form-group">
                    <label><b>Golongan</b></label>
                    <input type="text" name="golongan" class="form-control" placeholder="Golongan" >
                </div>
                <div class="form-group">
                    <label><b>Jabatan</b></label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" >
                </div>
                <div class="form-group">
                    <label><b>Rekening</b></label>
                    <input type="text" name="rekening" class="form-control" placeholder="Rekening" >
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

<!-- Form -->
<form hidden action="{{route('pejabat.update')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pejabat</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pejabat</h6>
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
                            <th>Nama</th>
                            <th>NIP</th>
                            <th style="width:40%;">Jabatan</th>
                            <th>Aksi</th>
                            <th hidden>nik</th>
                            <th hidden>golongan</th>
                            <th hidden>rekening</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                            <th hidden>nik</th>
                            <th hidden>golongan</th>
                            <th hidden>rekening</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($pejabat as $unit)
                        <tr>
                            <td>{{$unit->nama}}</td>
                            <td>{{$unit->nip}}</td>
                            <td>{{$unit->jabatan}}</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-primary border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                                <button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>
                            </td>
                            <th hidden>{{$unit->nik}}</th>
                            <th hidden>{{$unit->golongan}}</th>
                            <th hidden>{{$unit->rekenin}}</th>
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
    
    $modal.find('input[name=id]').val(data['ID']);
    $modal.find('input[name=nama]').val(data['Nama']);
    $modal.find('input[name=nip]').val(data['NIP']);
    $modal.find('input[name=nik]').val(data['nik']);
    $modal.find('input[name=golongan]').val(data['golongan']);
    $modal.find('input[name=jabatan]').val(data['Jabatan']);
    $modal.find('input[name=rekening]').val(data['rekening']);
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