@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Transaksi -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Transaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label><b>Tipe Transaksi</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" required >
                                <option value="">--Pilih--</option>
                                <option value="LS">LS</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label><b>Tanggal</b></label>
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input readonly type="text" class="form-control datetimepicker-input" data-target="#datetimepicker" id="tanggalref" name="tanggalref" required/>
                                <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <!-- <label><b>Tanggal</b></label>
                            <input type="text"  class="form-control" placeholder="Tanggal" required> -->
                        </div>  
                    </div>
                </div>                
                <div class="form-group">
                    <label><b>Subkegiatan</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idgrup" required >
                        <option value="">--Pilih--</option>
                        @foreach($subkegiatan as $sk)
                        <option value="{{$sk->idgrup}}">{{$sk->kode.', '.$sk->nama.', '.$sk->tahun}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idrekening" required >
                                <option value="">--Pilih--</option>
                                @foreach($rekening as $r)
                                <option value="{{$r->id}}">{{$r->kode.', '.$r->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekanan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idrekanan" required >
                                <option value="">--Pilih--</option>
                                @foreach($rekanan as $r)
                                <option value="{{$r->id}}">{{$r->nama}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                </div>        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jenis Transaksi</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="jenis" required >
                                <option value="">--Pilih--</option>
                                <option value="1" disabled>Debit</option>
                                <option value="0">Kredit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jumlah</b></label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Keterangan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="250" rows="3" style="resize: none;" required></textarea>
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
<form hidden action="{{route('transaksi.delete')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>
<!-- Form -->
<form hidden action="{{route('transaksi.tolak')}}" method="POST" id="tolak">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>
<!-- Form -->
<form hidden action="{{route('transaksi.acc')}}" method="POST" id="acc">
    @csrf
    @method('put')
    <input type="hidden" name="id">
    <input type="hidden" name="oldstatus">
</form>

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
                @if($user->role==='PKM')
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transaksitable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="mw-6rem"></th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Ket.</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            @if($user->role==='KEU')
                            <th>SPD</th>
                            <th>SOPD</th>
                            <th>SPD</th>
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th class="mw-6rem"></th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Ket.</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            @if($user->role==='KEU')
                            <th>SPD</th>
                            <th>SOPD</th>
                            <th>SPD</th>
                            @endif
                            <th>Aksi</th>
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
    
function hapus(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    $('#delete').find('input[name=id]').val(data['id']);
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

function show(self){
    var tr = $(self).closest('tr');
    var row = oTable.api().row( tr );
    var data=oTable.fnGetData(tr);

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        // btn.removeClass('btn-danger');
        // btn.addClass('btn-success');
        // btn.html('<i class="material-icons">add</i>')
    }
    else {
        row.child( format(data)).show();
        // tr.addClass('shown'); 
        // btn.addClass('btn-danger');
        // btn.removeClass('btn-success');
        // btn.html('<i class="material-icons">remove</i>')
    }
}

function tolak(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    $('#tolak').find('input[name=id]').val(data['id']);
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin menolak?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#tolak').submit();
        }
    })
}

function acc(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    var $acc= $('#acc');
    $acc.find('input[name=id]').val(data['id']);
    $acc.find('input[name=oldstatus]').val(data['status_raw']);
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin menyetujui?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#acc').submit();
        }
    })
}

function format(data){
    var str='<tr><td></td><td colspan="'+ @if($user->role==='KEU') '11' @else '8' @endif +'" style="bacground-color:#f9f9f9;">'+
        `<div class="row">
        <div class="col-md-4" id="riwayat">
            <h6><b>Riwayat</b></h6>
            <ul class="list-unstyled">
            </ul>
        </div>
        </div>
    </td></tr>`;
    var $view=$(str);
    
    let max=data.riwayat.length;
    let riwayatstr='<li>Request&nbsp'+data.tipe+
        '<p>'+data.tanggalref+'</p>'+
        (max===0?'':'<hr>')+
        '</li>';
    data.riwayat.forEach(function(e,i){
        let msg='';
        switch (i) {
            case 0:
                msg='PPD disetujui';
                break;
            case 1:
                msg='SOPD disetujui';
                break;
            case 2:
                msg='SPD disetujui';
                break;
        }
        riwayatstr+='<li>'+msg+
            '<button class="btn btn-sm btn-primary float-right">Print</button>'+
            '<p>'+e[0]+'</p>'+
            (max-1===i?'':'<hr>')+
            '</li>';
    });
    $view.find('#riwayat ul').append(riwayatstr);
    return $view;
    return $view.prop("outerHTML");
}

$(document).ready(function(){
    $('#tambah').find('select[name=jenis]').val('0').change().attr('readonly',true);

    @php
    $date=Carbon\Carbon::now();
    $maxDate=$date->format('Y-m-d');
    $date->day=1;
    $minDate=$date->format('Y-m-d');
    @endphp
    const maxDate='{{$maxDate}}';
    const minDate='{{$minDate}}';
    $('#datetimepicker').datetimepicker({
        locale: 'id',
        format: 'L',
        defaultDate: maxDate,
        maxDate: maxDate,
        minDate: minDate,
    });

    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {type: "POST", url: '{{route("transaksi.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' },
            { data:'tipe', orderable: false, width: '5.1rem'},
            { data:'tanggalref'},
            { data:'subkegiatan.nama',orderable: false},
            { data:'rekening.nama',orderable: false, width: '7rem'},
            { data:'keterangan', orderable: false, width: '23rem'},
            { data:'jenis'},
            { data:'jumlah'},
            @if($user->role==='KEU')
            { data:'ppd', orderable: false, searchable: false,  width: '3.5rem'},
            { data:'sopd', orderable: false, searchable: false,  width: '3.5rem'},
            { data:'spd', orderable: false, searchable: false,  width: '3.5rem'},
            @endif
            { data:'action', orderable: false, searchable: false, className: "text-right", width: '4rem'},
        ],
    }).yadcf([
        {
            column_number: 1,
            filter_default_label: 'Tipe',
            filter_type: "select",
            style_class:'c-filter-1',
            reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
            data:[
                {value:'LS',label:'LS'},
                {value:'TU',label:'TU'},
            ]
        },
    ]);
});
</script>
@endsection