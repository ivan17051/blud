@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Transaksi -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Transaksi" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>UPLS</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" required >
                                <option value="">--Pilih--</option>
                                <option value="UP">UP</option>
                                <option value="LS">LS</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Bayar Kepada</b></label>
                            <select class="form-control" name="dibayarkan" required onchange="filterFormulirOnChange(this)">
                                <option value="">--Pilih--</option>
                                <option value="1">Bendahara</option>
                                <option value="2">Rekanan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><b>.</b></label>
                            <select class="form-control" name="idrekanan" required >
                                <option value="">--Pilih--</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Keperluan</b></label>
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

<!-- Modal Ubah Rekening -->
<div class="modal modal-danger fade" id="ubahRek" tabindex="-1" role="dialog" aria-labelledby="Tambah Rekening" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahLabel">Ubah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="GET" id="addrekening">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>SubRekening</b></label>
                                <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" required>
                                    <option value="">--Pilih--</option>
                                    @foreach($rekening as $unit)
                                    <option value="{{$unit->id}}_{{$unit->nama}}">{{$unit->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Jumlah</b></label>
                                <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
                        </div>
                    </div>
                </form>
                <form action="{{route('transaksi.update')}}" method="POST" id="daftarrekening">
                <input type="hidden" name="id">
                @csrf
                @method('PUT')
                <table class="table" id="rekeningtable">
                    <thead>
                        <tr>
                            <th>Rekening</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" onclick="$('#daftarrekening').submit()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cetak sptb Transaksi -->
<div class="modal modal-danger fade" id="cetaksptb" tabindex="-1" role="dialog" aria-labelledby="Cetak SPTB" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="" method="GET" target="_blank">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak SPTB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Otorisator</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idotorisator" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cetak spp Transaksi -->
<div class="modal modal-danger fade" id="cetakspp" tabindex="-1" role="dialog" aria-labelledby="Cetak SPP" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="" method="GET" target="_blank">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak SPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Otorisator</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idotorisator" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label><b>Bendahara</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idbendahara" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cetak spm Transaksi -->
<div class="modal modal-danger fade" id="cetakspm" tabindex="-1" role="dialog" aria-labelledby="Cetak SPM" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="" method="GET" target="_blank">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak SPM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Pejabat</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idpejabat" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cetak sp2d Transaksi -->
<div class="modal modal-danger fade" id="cetakspd" tabindex="-1" role="dialog" aria-labelledby="Cetak SPD" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="" method="GET" target="_blank">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak SPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Pejabat</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idpejabat" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
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
    <input type="hidden" name="pesanpenolakan">
</form>
<!-- Form -->
<form hidden action="{{route('transaksi.acc')}}" method="POST" id="acc">
    @csrf
    @method('put')
    <input type="hidden" name="id">
    <input type="hidden" name="oldstatus">
    <input type="hidden" name="tipepembukuan">
</form>
<form hidden action="{{route('transaksi.batal')}}" method="POST" id="batal">
    @csrf
    @method('put')
    <input type="hidden" name="id">
</form>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                </div>
                @if($user->role==='PKM')
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Tambah Transaksi">Tambah</button>        
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
                            <th>Nomor</th>
                            <!-- <th>Rekening</th> -->
                            <th>Keperluan</th>
                            <!-- <th>Jenis</th> -->
                            <th>Jumlah</th>
                            @if(in_array($user->role,['KEU','PKM']))
                            <th>SPTB</th>
                            <th>SPP</th>
                            <th>SPM</th>
                            <th>SP2D</th>
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
                            <th>Nomor</th>
                            <!-- <th>Rekening</th> -->
                            <th>Keperluan</th>
                            <!-- <th>Jenis</th> -->
                            <th>Jumlah</th>
                            @if(in_array($user->role,['KEU','PKM']))
                            <th>SPTB</th>
                            <th>SPP</th>
                            <th>SPM</th>
                            <th>SP2D</th>
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

const bendahara = @json($pejabat);
const rekanan = @json($rekanan);

const filterFormulirOnChange = async function(e){
    var val = e.value;
    var str = '<option value="" disabled selected>--Pilih--</option>';
    
    var dt;
    if(val==='1'){ //bendahara
        dt=bendahara;
        $('select[name=idrekanan]').empty().html(bendahara);
    }else if(val==='2'){ //rekanan
        dt=rekanan;
        $('select[name=idrekanan]').empty().html(rekanan);
    }
    dt.forEach(e => {
        str+=`<option value="${e.id}">${e.nama}</option>`;
    });
    $('select[name=idrekanan]').empty().html(str);
}
    
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
        cancelButtonText: 'Batal',
        input: 'textarea',
        inputLabel: 'Pesan',
        inputPlaceholder: 'Tulis pesan di sini...',
        inputAttributes: {
            'aria-label': 'Tulis pesan di sini...',
            'maxlength' : '250',
        },
        preConfirm: (value) => {
            var newvalue=value.replace(/^\s+|\s+$/gm,'');
            if(newvalue===''){ 
                alert('Harap mengisi kolom pesan.');
                return false;
            }
            $('#tolak input[name=pesanpenolakan]').val(newvalue);
        },
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

function buatSpm(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    var $acc= $('#acc');
    $acc.find('input[name=id]').val(data['id']);
    $acc.find('input[name=oldstatus]').val(data['status_raw']);
    var strhtml='<select class="swal2-select" id="tipepembukuan">'+
            '<option value="">Jenis Pembukuan</option>'+
            '<option value="pindahbuku" >Pindah Buku</option>'+
            '<option value="tunai" >Tunai</option>'+
        '</select>'+
        '<input id="swal-input2" readonly class="swal2-input" value="BLUD" >';
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin membuat?',
        html: strhtml,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        preConfirm: () => {
            var val = document.getElementById('tipepembukuan').value;
            if(val==='') {
                alert("pilih tipe pembukuan");
                return false;
            }
            $acc.find('input[name=tipepembukuan]').val(val);
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $('#acc').submit();
        }
    })
}

function batal(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    var $batal= $('#batal');
    $batal.find('input[name=id]').val(data['id']);
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin membatalkan?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#batal').submit();
        }
    })
}

var oData={};
async function cetak(type, id){
    var data = oData[id];
    var pejabatPKM = await my.request.get('{{route('pejabat.byunitkerja',['idunitkerja'=>''])}}/'+id);
    console.log(pejabatPKM);
    switch (type) {
        case 'sptb':
            $('#cetaksptb form').attr('action',"{{url('sptb')}}/"+id);
            $('#cetaksptb').modal('show');
            break;
        case 'spp':
            $('#cetakspp form').attr('action',"{{url('spp')}}/"+id);
            $('#cetakspp').modal('show');
            break;
        case 'spm':
            $('#cetakspm form').attr('action',"{{url('spm')}}/"+id);
            $('#cetakspm').modal('show');
            break;
        case 'spd':
            $('#cetakspd form').attr('action',"{{url('spd')}}/"+id);
            $('#cetakspd').modal('show');
            break;
    }
}

function ubahRek(idtransaksi){
    $('#daftarrekening').find('input[name=id]').val(idtransaksi);
    $('#ubahRek').modal('show');
}

function format(data){
    //jika ada permintaan revisi, tampilkan pesan
    var pesanerror='';
    if(data.pesanpenolakan && data['status_raw']==="4"){
        pesanerror='<div class="alert alert-danger alert-solid" role="alert">'+data.pesanpenolakan+'</div>';
    }

    var rekeningstr = data.rekening.reduce(function(e,i){
        return e+='<tr><td> '+i[1]+' - '+i[2]+'</td><td> Rp. '+i[3]+' </td></tr>';
    },'');

    if(rekeningstr===''){
        rekeningstr='<tr><td class="text-center" colspan=2>Kosong</td><tr>'
    }
    
    var str='<tr><td></td><td colspan="'+ @if(in_array($user->role,['KEU','PKM'])) '12' @else '9' @endif +'" style="bacground-color:#f9f9f9;">'+pesanerror+
        `<table class="table">
            <thead>
                <tr><b><td width="70%"><b>Rekening</b></td><td><b>Jumlah</b></td></b></tr>
            </thead>
            <tbody>`+rekeningstr+
            `<tbody>  
            </table>
            <button class="btn btn-sm btn-primary float-right" onclick="ubahRek(${data.id})" title="Ubah Rekening">Ubah</button>
    </td></tr>`;
    var $view=$(str);

    //assign data ke object oData
    if(oData.hasOwnProperty(data['id'])===false){
        oData[data['id']]=data;
    }
    
    let max=data.riwayat.length;
    let riwayatstr='<li>Request&nbsp'+data.tipe+
        '<p>'+data.tanggalref+'</p>'+
        (max===0?'':'<hr>')+
        '</li>';
    data.riwayat.forEach(function(e,i){
        let msg=e[2];
        riwayatstr+='<li>'+msg+
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
            { data:'nomor'},
            { data:'keterangan', orderable: false, width: '23rem'},
            { data:'jumlah'},
            @if(in_array($user->role,['KEU','PKM']))
            { data:'sptb', orderable: false, searchable: false },
            { data:'spp', orderable: false, searchable: false },
            { data:'spm', orderable: false, searchable: false },
            { data:'sp2d', orderable: false, searchable: false },
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

    $('#addrekening').submit(function(e){
        e.preventDefault();
        var inputan= my.getFormData($(e.target));
        var rekening=inputan['tipe'].split('_');
        var str=`<tr>
                <td>${rekening[1]}<input type="hidden" name="rekening[]" value="${rekening[0]}" required></td>
                <td>${inputan['jumlah']}<input type="hidden" name="jumlah[]" value="${inputan['jumlah']}" required></td>
                <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
            </tr>`;
        $('#rekeningtable tbody').append(str);
    })
});
</script>
@endsection