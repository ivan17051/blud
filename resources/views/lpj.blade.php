@extends('layouts.layout')

@section('lpjStatus')
active
@endsection

@section('content')

<!-- Modal Tambah LPJ -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah LPJ" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah LPJ-UP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('lpj.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Tanggal Pengeluaran</b></label>
                            <input type="date" id="tanggalref" name="tanggalref" class="form-control" onchange="fillBulanLPJ(this, '#tambah')" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Bulan akan di-SPJ kan</b></label>
                            <select class="form-control" id="bulanlpj" name="bulanlpj" required disabled>
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
                  <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Subkegiatan</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="idsubkegiatan" required>
                          <option value="" selected disabled>--Pilih--</option>
                          @foreach($subkegiatan as $unit)
                          <option value="{{$unit->id}}">{{$unit->kode}} - {{$unit->nama}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                </div>
                
                <table class="table table-bordered">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detil LPJ -->
<style>
#table-detil-2{
    width: 100%!important;
}
</style>
<div class="modal modal-danger fade" id="detil" tabindex="-1" role="dialog" aria-labelledby="Detil LPJ" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Detil LPJ-UP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Tanggal Pengeluaran</b></label>
                            <input type="date" name="tanggalref" class="form-control" onchange="fillBulanLPJ(this, '#detil')" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Bulan akan di-SPJ kan</b></label>
                            <select class="form-control" name="bulanlpj" required disabled>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Subkegiatan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" data-size="5" name="idsubkegiatan" required>
                            <option value="" selected disabled>--Pilih--</option>
                            @foreach($subkegiatan as $unit)
                            <option value="{{$unit->id}}">{{$unit->kode}} - {{$unit->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <table class="table table-bordered" id="table-detil-2">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    <h1 class="h3 mb-2 text-gray-800">Lembar Pertanggung Jawaban (LPJ)</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                  <h6 class="m-0 font-weight-bold text-primary">LPJ</h6>
                </div>
                <div class="col text-right">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Tambah
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#" onclick="handleOpenModalTambah('UP')" title="Add LPJ-UP">LPJ-UP</a>
                        <a class="dropdown-item" href="#" onclick="handleOpenModalTambah('TU')" title="Add LPJ-TU">LPJ-TU</a>
                      </div>
                    </div>
                  </div>
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

const fillBulanLPJ = async function(e, modal){
    var $modal=$(modal);
    
    var date = new Date(e.value);
    var month = date.getMonth();
    
    $modal.find('select[name=bulanlpj]').val(month+1).change();
}

function renderKodeTransaksi(e,d,row){
    if(row['transaksi']){
        return '<button type="button" class="btn btn-sm btn-light text-nowrap border-1-gray-1 rounded-pill" ><i class="o-f-edelivery" ></i> '+row['kodetransaksi']+'</button>';
    }
    return '-';
}

function openDetilLPJ(self, urlparams, idmodal, route='getrelatedbku'){
    $table = $(idmodal).find('table');
    if ($.fn.dataTable.isDataTable($table) ) {
        $table.DataTable().clear();
        $table.DataTable().destroy();
        $table.empty();
    }

    if(route === 'getrelatedbku'){
        url = '{{route("lpj.getrelatedbku", ["idlpj"=>''])}}';
    }else{
        url = '{{route("lpj.getbkubyperiod", ["idsubkegiatan"=> '', "tipe"=>'', "month"=>'', "year"=>''])}}';
    }
    console.log(url);

    $table.dataTable({
        processing: true,
        ajax: {type: "GET", url: url+urlparams, data:{'_token':@json(csrf_token())}},
        columns: [
            {title:"Nomor", data: "nomor"},
            {title:"tanggal", data: "tanggalref", render: function(e,d,row){return moment(row['tanggalref']).format('L');}},
            {title:"e-SPJ", data: "transaksi", render: renderKodeTransaksi },
            {title:"Rekening", data: "rekening.kode"},
            {title:"Uraian", data: "uraian"},
            {title:"Nominal", data: "nominal"}
        ],
        initComplete: function(){
            let $modal = $(idmodal);
            if(route === 'getrelatedbku'){
                var tr = $(self).closest('tr');
                var data = oTable.api().row(tr).data();
                $modal.find('[name=tanggalref]').val(data['tanggal']).change().attr('readonly',true);
                $modal.find('[name=idsubkegiatan]').val(data['idsubkegiatan']).change().attr('readonly',true);
                $modal.find('.modal-title').text('Detil LPJ-'+data['tipe_raw']);
                $modal.modal('show');
            }
            
        },
    });
}

function handleChangeModalTambah(tipe){
    let $modal = $('#tambah');
    let tanggal = $modal.find('[name=tanggalref]').val();
    let idsubkegiatan = $modal.find('[name=idsubkegiatan]').val();
    console.log(tanggal, idsubkegiatan);
    if( tanggal === '' || idsubkegiatan === null) return;
    tanggal = moment(tanggal);
    let urlparams = '/'+idsubkegiatan+'/'+tipe+'/'+tanggal.format('MM')+'/'+tanggal.format('y');
    openDetilLPJ($modal[0], urlparams, '#tambah', route='getbkubyperiod');
}

function handleOpenModalTambah(tipe){
    let $modal = $('#tambah');
    $modal.find('[name=tanggalref]').on( "change", function() {handleChangeModalTambah(tipe);});
    $modal.find('[name=idsubkegiatan]').on('change', function() {handleChangeModalTambah(tipe);});
    $modal.find('.modal-title').text('Detil LPJ-'+tipe);
    $modal.modal('show');
}

$(document).ready(function(){
  
    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {type: "POST", url: '{{route("lpj.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { title: 'Nomor', data: "nomor"},
            { title: 'Tipe', data: "tipe"},
            { title: 'Periode', data: "tanggal", render: function(e,d,row){return moment(row['tanggal']).format('MMMM');}},
            { title: 'Tahun', data: "tanggal", render: function(e,d,row){return moment(row['tanggal']).format('Y');}},
            { title: 'Nominal', data: "total"},
            { title: 'Aksi', data: "action", orderable: false, searchable: false, width:1},
        ],
    });

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