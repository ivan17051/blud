@extends('layouts.layout')

@section('spjStatus')
active
@endsection

@section('content')

<!-- Modal Tambah SPJ -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah SPJ" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah SPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('spj.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>ID Pekerjaan</b></label>
                            <input type="text" id="kodepekerjaan" name="kodepekerjaan" class="form-control" placeholder="ID Pekerjaan" required minlength=8 maxlength=8>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>ID Transaksi</b></label>
                            <input type="text" id="kodetransasi2" name="kodetransaksi" class="form-control" placeholder="ID Transaksi" required minlength=7 maxlength=7>
                        </div>  
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><b>UPLS</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" onchange="cekTipe(this, '#tambah')" required>
                              <option value="" selected disabled>--Pilih--</option>
                              <option>UP</option>
                              <option>LS</option>
                              <option>TU</option>
                            </select>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekanan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="idrekanan" onchange="filterFormulirOnChange(this, '#tambah')" required>
                              <option value="">--Pilih--</option>
                              @foreach($rekanan as $unit)
                              <option value="{{$unit->id}}">{{$unit->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Tanggal Pengeluaran</b></label>
                            <input type="date" id="tanggalref" name="tanggalref" class="form-control" onchange="fillBulanSPJ(this, '#tambah')" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Bulan akan di-SPJ kan</b></label>
                            <select class="form-control" id="bulanspj" name="bulanspj" required disabled>
                              <option value="" selected disabled>--Pilih--</option>
                              <option value="1">Januari</option>
                              <option value="2">Februari</option>
                              <option value="3">Maret</option>
                              <option value="4">April</option>
                              <option value="5">Mei</option>
                              <option value="6">Juni</option>
                              <option value="7">Juli</option>
                              <option value="8">Agustus</option>
                              <option value="9">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Pimpinan</b></label>
                            <input type="text" id="pimpinan" name="pimpinan" class="form-control" placeholder="Pimpinan" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>NPWP</b></label>
                            <input type="text" id="npwp" name="npwp" class="form-control" placeholder="NPWP" disabled>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Nama Bank</b></label>
                            <input type="text" id="namabank" name="namabank" class="form-control" placeholder="Nama Bank" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>No. Rekening</b></label>
                            <input type="text" id="norek" name="norek" class="form-control" placeholder="No. Rekening" disabled>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="rekening" required>
                              <option value="" selected disabled>--Pilih--</option>
                              @foreach($rekening as $unit)
                              <option value="{{$unit->id}}">{{$unit->kode}} - {{$unit->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jumlah</b></label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required>
                        </div>  
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Keperluan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keperluan" maxlength="250" rows="2" style="resize: none;" required></textarea>
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

<!-- Modal Sunting SPJ -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting SPJ" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suntingLabel">Sunting SPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('spj.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>ID Pekerjaan</b></label>
                            <input type="text" id="kodepekerjaan2" name="kodepekerjaan" class="form-control" placeholder="ID Pekerjaan" required minlength=8 maxlength=8>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>ID Transaksi</b></label>
                            <input type="text" id="kodetransasi" name="kodetransaksi" class="form-control" placeholder="ID Transaksi" required minlength=7 maxlength=7>
                        </div>  
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><b>UPLS</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" onchange="cekTipe(this, '#sunting')" required>
                              <option value="" selected disabled>--Pilih--</option>
                              <option>UP</option>
                              <option>LS</option>
                              <option>TU</option>
                            </select>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekanan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="idrekanan" required onchange="filterFormulirOnChange(this, '#sunting')">
                              <option value="">--Pilih--</option>
                              @foreach($rekanan as $unit)
                              <option value="{{$unit->id}}">{{$unit->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Tanggal Pengeluaran</b></label>
                            <input type="date" id="tanggalref2" name="tanggalref" class="form-control" onchange="fillBulanSPJ(this, '#sunting')" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Bulan akan di-SPJ kan</b></label>
                            <select disabled class="form-control" name="bulanspj" required>
                              <option value="" selected disabled>--Pilih--</option>
                              <option value="1">Januari</option>
                              <option value="2">Februari</option>
                              <option value="3">Maret</option>
                              <option value="4">April</option>
                              <option value="5">Mei</option>
                              <option value="6">Juni</option>
                              <option value="7">Juli</option>
                              <option value="8">Agustus</option>
                              <option value="9">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Pimpinan</b></label>
                            <input type="text" id="pimpinan2" name="pimpinan" class="form-control" placeholder="Pimpinan" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>NPWP</b></label>
                            <input type="text" id="npwp2" name="npwp" class="form-control" placeholder="NPWP" disabled>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Nama Bank</b></label>
                            <input type="text" id="namabank2" name="namabank" class="form-control" placeholder="Nama Bank" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>No. Rekening</b></label>
                            <input type="text" id="norek2" name="norek" class="form-control" placeholder="No. Rekening" disabled>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="rekening" required>
                              <option value="" selected disabled>--Pilih--</option>
                              @foreach($rekening as $unit)
                              <option value="{{$unit->id}}">{{$unit->kode}} - {{$unit->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jumlah</b></label>
                            <input type="text" id="jumlah2" name="jumlah" class="form-control" placeholder="Jumlah" required>
                        </div>  
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Keperluan</b></label>
                    <textarea id="keterangan2" name="keterangan" class="form-control" placeholder="Keperluan" maxlength="250" rows="2" style="resize: none;" required></textarea>
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

<!-- Form Delete -->
<form hidden action="{{route('spj.update')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Surat Pertanggung Jawaban (SPJ)</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">SPJ</h6>
                </div>
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
            <div class="mb-2" style="max-width: 10rem;">
                    <select class="selectpicker" data-none-selected-text="Filter" data-live-search="true" multiple data-show-tick style="max-width: 10rem;" id="filterSelect">
                        <optgroup label="Tipe Transaksi" data-max-options="1">
                            <option value="UP">UP</option>
                            <option value="LS">LS</option>
                            <option value="TU">TU</option>
                        </optgroup>
                        @if(in_array($user->role,['KEU','PIH','admin']))
                        <optgroup label="PKM" data-max-options="1">
                            <option value="TANJUNGSARI">PKM TANJUNGSARI</option>
                            <option value="SIMOMULYO">PKM SIMOMULYO</option>
                            <option value="MANUKANKULON">PKM MANUKAN KULON</option>
                            <option value="BALONGSARI">PKM BALONGSARI</option>
                            <option value="ASEMROWO">PKM ASEMROWO</option>
                            <option value="SEMEMI">PKM SEMEMI</option>
                            <option value="BENOWO">PKM BENOWO</option>
                            <option value="JERUK">PKM JERUK</option>
                            <option value="LIDAHKULON">PKM LIDAH KULON</option>
                            <option value="LONTAR">PKM LONTAR</option>
                            <option value="PENELEH">PKM PENELEH</option>
                            <option value="KETABANG">PKM KETABANG</option>
                            <option value="KEDUNGDORO">PKM KEDUNGDORO</option>
                            <option value="DRSOETOMO">PKM DR. SOETOMO</option>
                            <option value="TEMBOKDUKUH">PKM TEMBOK DUKUH</option>
                            <option value="GUNDIH">PKM GUNDIH</option>
                            <option value="TAMBAKREJO">PKM TAMBAKREJO</option>
                            <option value="SIMOLAWANG">PKM SIMOLAWANG</option>
                            <option value="PERAKTIMUR">PKM PERAK TIMUR</option>
                            <option value="PEGIRIAN">PKM PEGIRIAN</option>
                            <option value="SIDOTOPO">PKM SIDOTOPO</option>
                            <option value="WONOKUSUMO">PKM WONOKUSUMO</option>
                            <option value="KREMBANGANSELATAN">PKM KREMBANGAN SELATAN</option>
                            <option value="DUPAK">PKM DUPAK</option>
                            <option value="KENJERAN">PKM KENJERAN</option>
                            <option value="TAKAL">PKM Tanah KALI KEDINDING</option>
                            <option value="SIDOTOPOWETAN">PKM SIDOTOPO WETAN</option>
                            <option value="RANGKAH">PKM RANGKAH</option>
                            <option value="PACARKELING">PKM PACAR KELING</option>
                            <option value="GADING">PKM GADING</option>
                            <option value="PUCANGSEWU">PKM PUCANGSEWU</option>
                            <option value="MOJO">PKM MOJO</option>
                            <option value="KALIRUNGKUT">PKM KALIRUNGKUT</option>
                            <option value="MEDOKANAYU">PKM MEDOKAN AYU</option>
                            <option value="TENGGILIS">PKM TENGGILIS</option>
                            <option value="GUNUNGANYAR">PKM GUNUNG ANYAR</option>
                            <option value="MENUR">PKM MENUR</option>
                            <option value="KLAMPISNGASEM">PKM KLAMPIS NGASEM</option>
                            <option value="MULYOREJO">PKM MULYOREJO</option>
                            <option value="SAWAHAN">PKM SAWAHAN</option>
                            <option value="PUTATJAYA">PKM PUTAT JAYA</option>
                            <option value="BANYUURIP">PKM BANYU URIP</option>
                            <option value="PAKIS">PKM PAKIS</option>
                            <option value="JAGIR">PKM JAGIR</option>
                            <option value="WONOKROMO">PKM WONOKROMO</option>
                            <option value="NGAGELREJO">PKM NGAGEL REJO</option>
                            <option value="KEDURUS">PKM KEDURUS</option>
                            <option value="DUKUHKUPANG">PKM DUKUH KUPANG</option>
                            <option value="WIYUNG">PKM WIYUNG</option>
                            <option value="GAYUNGAN">PKM GAYUNGAN</option>
                            <option value="JEMURSARI">PKM JEMURSARI</option>
                            <option value="SIDOSERMO">PKM SIDOSERMO</option>
                            <option value="KEBONSARI">PKM KEBONSARI</option>
                            <option value="BANGKINGAN">PKM BANGKINGAN</option>
                            <option value="MADE">PKM MADE</option>
                            <option value="MOROKREMBANGAN">PKM MORO KREMBANGAN </option>
                            <option value="TAMBAKWEDI">PKM TAMBAK WEDI</option>
                            <option value="BULAKBANTENG">PKM BULAK BANTENG</option>
                            <option value="KEPUTIH">PKM KEPUTIH</option>
                            <option value="KALIJUDAN">PKM KALIJUDAN</option>
                            <option value="BALASKLUMPRIK">PKM BALAS KLUMPRIK</option>
                            <option value="SIWALANKERTO">PKM SIWALANKERTO</option>
                            <option value="SAWAHPULO">PKM SAWAH PULO</option>
                        </optgroup>
                        @endif
                    </select>
                </div>
                <div class="h-100 d-inline-block">
                    <input id="tagsinput" hidden type="text" value="" class="tagsinput" data-role="tagsinput" data-size="md" data-color="info" data-role="filter">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="transaksitable" width="100%" cellspacing="0">
                    <thead>
                    </thead>
                    <tbody>
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

const rekanan = @json($rekanan);
// console.log(rekanan[0]);

const filterFormulirOnChange = async function(e, modal){
    var $modal=$(modal);
    var val = e.value;
    
    var dt;
    dt=rekanan;
    var pos = rekanan.findIndex(function(e){return e.id==val;});
    
    $modal.find('input[name=pimpinan]').val(rekanan[pos]['pimpinan']);
    $modal.find('input[name=npwp]').val(rekanan[pos]['npwp']);
    $modal.find('input[name=namabank]').val(rekanan[pos]['namabank']);
    $modal.find('input[name=norek]').val(rekanan[pos]['rekening']);
}

const cekTipe = async function(e,modal){
    var $modal=$(modal);
    if(e.value=='UP'){
        $modal.find('select[name=idrekanan]').removeAttr('required').change();
    }
    else{
        $modal.find('select[name=idrekanan]').attr('required', true);
    }
}

const fillBulanSPJ = async function(e, modal){
    var $modal=$(modal);
    
    var date = new Date(e.value);
    var month = date.getMonth();
    
    $modal.find('select[name=bulanspj]').val(month+1).change();
}

function edit(self){
    var $modal=$('#sunting');
    var tr = $(self).closest('tr');
    var data = oTable.fnGetData(tr);
    
    $modal.find('input[name=id]').val(data['id']);
    $modal.find('select[name=tipe]').val(data['tipe_raw']).change();
    $modal.find('input[name=tanggalref]').val(data['tanggalref_raw']);
    $modal.find('input[name=kodetransaksi]').val(data['kodetransaksi']);
    $modal.find('input[name=kodepekerjaan]').val(data['kodepekerjaan']);
    $modal.find('select[name=idrekanan]').val(data['idkepada']).change();
    $modal.find('textarea[name=keterangan]').val(data['keterangan']);
    $modal.find('select[name=rekening]').val(data['rekening'][0][0]).change();
    $modal.find('input[name=jumlah]').val(data['rekening'][0][3]);

    var pos = rekanan.findIndex(function(e){return e.id==data['idkepada'];});
    var date = new Date(data['tanggalref_raw']);
    var month = date.getMonth();

    $modal.find('input[name=pimpinan]').val(rekanan[pos]['pimpinan']);
    $modal.find('input[name=npwp]').val(rekanan[pos]['npwp']);
    $modal.find('input[name=namabank]').val(rekanan[pos]['namabank']);
    $modal.find('input[name=norek]').val(rekanan[pos]['rekening']);
    $modal.find('select[name=bulanspj]').val(month+1).change();
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
    }
    else {
        row.child( format(data)).show();
    }
}

function format(data){
    var rekeningstr = data.rekening.reduce(function(e,i){
        return e+='<tr><td> '+i[1]+' - '+i[2]+'</td><td> '+number_format(i[3],0,',','.')+' </td></tr>';
    },'');

    if(rekeningstr===''){
        rekeningstr='<tr><td class="text-center" colspan=2>Kosong</td><tr>'
    }

    var str='<tr><td></td><td colspan="'+ @if(in_array($user->role,['PKM'])) '12' @elseif(in_array($user->role,['KEU'])) '9' @else '8' @endif +'" style="bacground-color:#f9f9f9;">'+
    '<div class="tab-content" id="myTabContent">'+
        `<div class="tab-pane fade show active" id="rekening_${data.id}" role="tabpanel" aria-labelledby="rekening_${data.id}"><table class="table">
            <thead>
                <tr><th width="70%"><b>Rekening</b></th><th><b>Jumlah</b></th></tr>
            </thead>
            <tbody>`+rekeningstr+
            `<tbody>  
            </table></div>`+
    '</div>'+
    '</td></tr>';
            
    var $view=$(str);
    
    return $view;
    return $view.prop("outerHTML");
}

$(document).ready(function(){
    $('#tambah').find('select[name=jenis]').val('0').change().attr('readonly',true);
  
    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {type: "POST", url: '{{route("spj.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' , title:'No.', name:'no'},
            { data:'tipe', orderable: false, width: 1 , title:'Tipe', name:'tipe'},
            { data:'tanggalref', title:'Tanggal', name:'tanggalref'},
            { data:'kodetransaksi', title:'ID Transaksi', name:'kodetransaksi'},
            { data:'kodepekerjaan', title:'ID Pekerjaan', name:'kodepekerjaan'},
            { data:'keterangan', orderable: false, width: '23rem', title:'Keperluan', name:'keterangan'},
            @if(in_array($user->role,['PKM']))
            { data:'action', orderable: false, searchable: false, className: "text-right", width: '3rem', title:'Aksi', name:'aksi'},
            @endif
            { data:'unitkerja', visible: false, name:'unitkerja.nama_alias'},
            { data:'idrekanan', visible: false, name:'idrekanan'},
            { data:'tanggalref_raw', visible: false, name:'tanggalref_raw'},
            { data:'rekening', visible: false, name:'rekening'},
            { data:'tipe_raw', visible: false, name:'tipe_raw'},
        ],
    }).yadcf([
        // {
        //     column_number: 1,
        //     filter_default_label: 'Tipe',
        //     filter_type: "select",
        //     style_class:'c-filter-1',
        //     reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
        //     data:[
        //         {value:'LS',label:'LS'},
        //         {value:'TU',label:'TU'},
        //     ]
        // },
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
        //reset input
        $('#addrekening input').val('');
        $('#addrekening select').val('').change();
    });

    $('#addpajak').submit(function(e){
        e.preventDefault();
        var inputan= my.getFormData($(e.target));
        var pajak=inputan['tipe'].split('_');
        var tanggalkadaluarsa_date = moment(inputan['tanggalkadaluarsa'],"DD/MM/YYYY").format('y-MM-DD');
        var str=`<tr>
                <td>${pajak[1]}<input type="hidden" name="pajak[]" value="${pajak[0]}" required></td>
                <td>${inputan['kodebilling']}<input type="hidden" name="kodebilling[]" value="${inputan['kodebilling']}" required></td>
                <td>${inputan['tanggalkadaluarsa']}<input type="hidden" name="tanggalkadaluarsa[]" value="${tanggalkadaluarsa_date}" required></td>
                <td>${inputan['nominal']}<input type="hidden" name="nominalpajak[]" value="${inputan['nominal']}" required></td>
                <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
            </tr>`;
        $('#pajaktable tbody').append(str);
        //reset input
        $('#addpajak input').val('');
        $('#addpajak select').val('').change();
    });

    $('#addpotongan').submit(function(e){
        e.preventDefault();
        var inputan= my.getFormData($(e.target));
        var str=`<tr>
                <td>${inputan['kode']}<input value="${inputan['kode']}" type="hidden" name="kodepotongan[]"></input></td>
                <td>${inputan['potongan']}<input value="${inputan['potongan']}" type="hidden" name="potongan[]"></input></td>
                <td>${inputan['nominal']}<input value="${inputan['nominal']}" type="hidden" name="nominalpotongan[]"></input></td>
                <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
            </tr>`;
        $('#potongantable tbody').append(str);
        //reset input
        $('#addpotongan input').val('');
        $('#addpotongan select').val('').change();
    })

    // START: Section of Filter 
    var tagContainer=$('#tagsinput');
    var selectContainer=$('#filterSelect');
    tagContainer.tagsinput('input').attr('hidden',true);
    tagContainer.on('itemRemoved', function(e) {
        selectContainer.val($(this).tagsinput('items'));
        selectContainer.selectpicker('refresh');
    });
    selectContainer.on('changed.bs.select', function (e) {
        selectContainer.selectpicker('refresh');
    });
    selectContainer.on('refreshed.bs.select', function (e) {
        var values=$(e.target).val();
        tagContainer.tagsinput('removeAll');
        oTable.api().columns().search( '' ); //reset semua filter
        values.forEach(function(s, i){
            var label=$(selectContainer[0].selectedOptions[i]).closest('optgroup').prop('label');            
            tagContainer.tagsinput('add', s);
            console.log(s);
            switch (label) {
                case "Status":
                    if(s==="ACCEPTED"){
                        oTable.api().column('status:name').search( 3 , true, false)
                    }else if(s==="SPM TERTOLAK"){
                        oTable.api().column('status:name').search( 4 , true, false)
                    }
                    break;
                case "Tipe Transaksi":
                    oTable.api().column('tipe:name').search( s , true, false)
                    break;
                case "PKM":
                    oTable.api().column('unitkerja.nama_alias:name').search( s , true, false)
                    break;
            }
        });
        oTable.api().draw();    // filter tabel
    });
    // END: Section of Filter 

});
</script>
@endsection