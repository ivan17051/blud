@extends('layouts.layout')

@section('masterShow')
show
@endsection

@section('pajakStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Pajak -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Pajak" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pajak.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Kode Pajak</b></label>
                    <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode Pajak" required>
                </div>
                <div class="form-group">
                    <label><b>Nama Pajak</b></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Pajak" required>
                </div>
                <div class="form-group">
                    <label><b>Pajak Referensi</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="parent" >
                        <option value="">--Tidak Ada--</option>
                        @foreach($parent as $p)
                        <option value="{{ $p->id }}">{{ $p->kode.' - '.$p->nama }}</option>
                        @endforeach
                    </select>
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

<!-- Modal Sunting Pajak -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting Pajak" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suntingLabel">Sunting Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pajak.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Kode Pajak</b></label>
                    <input type="text" name="kode" class="form-control" placeholder="Kode Pajak" required>
                </div>
                <div class="form-group">
                    <label><b>Nama Pajak</b></label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pajak" required>
                </div>
                <div class="form-group">
                    <label><b>Pajak Referensi</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="parent" >
                        <option value="">--Tidak Ada--</option>
                        @foreach($parent as $p)
                        <option value="{{ $p->id }}">{{ $p->kode.' - '.$p->nama }}</option>
                        @endforeach
                    </select>
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
<form hidden action="{{route('pajak.delete')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pajak</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pajak</h6>
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
                            <th>Kode Pajak</th>
                            <th width="70%">Nama Pajak</th>
                            <th>Aksi</th>
                            <th hidden>Parent</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th hidden>ID</th>
                            <th>Kode Pajak</th>
                            <th>Nama Pajak</th>
                            <th>Aksi</th>
                            <th hidden>Parent</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($pajak as $unit)
                        <tr>
                            <td hidden>{{$unit->id}}</td>
                            <td>{{$unit->kode}}</td>
                            <td>{{$unit->nama}}</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                                <button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>
                            </td>
                            <td hidden>{{$unit->parent}}</td>
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
    $modal.find('input[name=kode]').val(data['Kode Pajak']);
    $modal.find('input[name=nama]').val(data['Nama Pajak']);
    $modal.find('select[name=parent]').val(data['Parent']).change();
    // $('.selectpicker').selectpicker('refresh')
}

function hapus(self){
    var tr = $(self).closest('tr');
    var data=oTable.row(tr).data().reduce(function(res,val,i){
        res[oTable.cols[i]]=val;
        return res;
    },{});
    $('#delete').find('input[name=id]').val(data['ID']);
    console.log(data['ID']);
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