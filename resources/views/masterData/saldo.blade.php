@extends('layouts.layout')

@section('masterShow')
show
@endsection

@section('saldoStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Saldo -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Saldo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Ubah Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('saldo.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="idunitkerja">
            <input type="hidden" name="idrekening">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Kode</b></label>
                    <input type="text" id="koderekening" name="koderekening" class="form-control">
                </div>
                <div class="form-group">
                    <label><b>Nama Rekening</b></label>
                    <input type="text" id="namarekening" name="namarekening" class="form-control">
                </div>
                <!-- <div class="form-group">
                    <label><b>Tanggal</b></label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                </div> -->
                <div class="form-group">
                    <label><b>Saldo</b></label>
                    <input type="text" id="saldo" name="saldo" class="form-control" placeholder="Saldo" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                </div>
                <!-- <div class="form-group">
                    <label><b>Keterangan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="99" rows="3" style="resize: none;"></textarea>
                </div> -->
                <div class="form-group">
                    <label style="color:var(--danger);"><b>Appli untuk semua PKM <i class="fas fa-exclamation-triangle"></i></b></label>
                    <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="isall" name="isall" >
                        <label class="custom-control-label" for="isall"></label>
                        <label class="custom-control-status-2" for="isall" style="vertical-align: sub;"></label>
                    </div>
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
    <h1 class="h3 mb-2 text-gray-800">Data Saldo</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <div class="card shadow mb-4" id="saldocontainer">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Saldo</h6>
                </div>
                <!-- <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Ubah</button>        
                </div> -->
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="mb-2" style="max-width: 10rem;">
                    <select class="selectpicker" data-none-selected-text="Filter" data-live-search="true" multiple data-show-tick style="max-width: 10rem;" id="filterSelect">
                        <optgroup label="PKM" data-max-options="1">
                            <option value="TANJUNGSARI" data-idunitkerja="38" >PKM TANJUNGSARI</option>
                            <option value="SIMOMULYO" data-idunitkerja="39" >PKM SIMOMULYO</option>
                            <option value="MANUKANKULON" data-idunitkerja="40" >PKM MANUKAN KULON</option>
                            <option value="BALONGSARI" data-idunitkerja="41" >PKM BALONGSARI</option>
                            <option value="ASEMROWO" data-idunitkerja="42" >PKM ASEMROWO</option>
                            <option value="SEMEMI" data-idunitkerja="43" >PKM SEMEMI</option>
                            <option value="BENOWO" data-idunitkerja="44" >PKM BENOWO</option>
                            <option value="JERUK" data-idunitkerja="45" >PKM JERUK</option>
                            <option value="LIDAHKULON" data-idunitkerja="46" >PKM LIDAH KULON</option>
                            <option value="LONTAR" data-idunitkerja="47" >PKM LONTAR</option>
                            <option value="PENELEH" data-idunitkerja="48" >PKM PENELEH</option>
                            <option value="KETABANG" data-idunitkerja="49" >PKM KETABANG</option>
                            <option value="KEDUNGDORO" data-idunitkerja="50" >PKM KEDUNGDORO</option>
                            <option value="DRSOETOMO" data-idunitkerja="51" >PKM DR. SOETOMO</option>
                            <option value="TEMBOKDUKUH" data-idunitkerja="52" >PKM TEMBOK DUKUH</option>
                            <option value="GUNDIH" data-idunitkerja="53" >PKM GUNDIH</option>
                            <option value="TAMBAKREJO" data-idunitkerja="54" >PKM TAMBAKREJO</option>
                            <option value="SIMOLAWANG" data-idunitkerja="55" >PKM SIMOLAWANG</option>
                            <option value="PERAKTIMUR" data-idunitkerja="56" >PKM PERAK TIMUR</option>
                            <option value="PEGIRIAN" data-idunitkerja="57" >PKM PEGIRIAN</option>
                            <option value="SIDOTOPO" data-idunitkerja="58" >PKM SIDOTOPO</option>
                            <option value="WONOKUSUMO" data-idunitkerja="59" >PKM WONOKUSUMO</option>
                            <option value="KREMBANGANSELATAN" data-idunitkerja="60" >PKM KREMBANGAN SELATAN</option>
                            <option value="DUPAK" data-idunitkerja="61" >PKM DUPAK</option>
                            <option value="KENJERAN" data-idunitkerja="62" >PKM KENJERAN</option>
                            <option value="TAKAL" data-idunitkerja="63" >PKM Tanah KALI KEDINDING</option>
                            <option value="SIDOTOPOWETAN" data-idunitkerja="64" >PKM SIDOTOPO WETAN</option>
                            <option value="RANGKAH" data-idunitkerja="65" >PKM RANGKAH</option>
                            <option value="PACARKELING" data-idunitkerja="66" >PKM PACAR KELING</option>
                            <option value="GADING" data-idunitkerja="67" >PKM GADING</option>
                            <option value="PUCANGSEWU" data-idunitkerja="68" >PKM PUCANGSEWU</option>
                            <option value="MOJO" data-idunitkerja="69" >PKM MOJO</option>
                            <option value="KALIRUNGKUT" data-idunitkerja="70" >PKM KALIRUNGKUT</option>
                            <option value="MEDOKANAYU" data-idunitkerja="71" >PKM MEDOKAN AYU</option>
                            <option value="TENGGILIS" data-idunitkerja="72" >PKM TENGGILIS</option>
                            <option value="GUNUNGANYAR" data-idunitkerja="73" >PKM GUNUNG ANYAR</option>
                            <option value="MENUR" data-idunitkerja="74" >PKM MENUR</option>
                            <option value="KLAMPISNGASEM" data-idunitkerja="75" >PKM KLAMPIS NGASEM</option>
                            <option value="MULYOREJO" data-idunitkerja="76" >PKM MULYOREJO</option>
                            <option value="SAWAHAN" data-idunitkerja="77" >PKM SAWAHAN</option>
                            <option value="PUTATJAYA" data-idunitkerja="78" >PKM PUTAT JAYA</option>
                            <option value="BANYUURIP" data-idunitkerja="79" >PKM BANYU URIP</option>
                            <option value="PAKIS" data-idunitkerja="80" >PKM PAKIS</option>
                            <option value="JAGIR" data-idunitkerja="81" >PKM JAGIR</option>
                            <option value="WONOKROMO" data-idunitkerja="82" >PKM WONOKROMO</option>
                            <option value="NGAGELREJO" data-idunitkerja="83" >PKM NGAGEL REJO</option>
                            <option value="KEDURUS" data-idunitkerja="84" >PKM KEDURUS</option>
                            <option value="DUKUHKUPANG" data-idunitkerja="85" >PKM DUKUH KUPANG</option>
                            <option value="WIYUNG" data-idunitkerja="86" >PKM WIYUNG</option>
                            <option value="GAYUNGAN" data-idunitkerja="87" >PKM GAYUNGAN</option>
                            <option value="JEMURSARI" data-idunitkerja="88" >PKM JEMURSARI</option>
                            <option value="SIDOSERMO" data-idunitkerja="89" >PKM SIDOSERMO</option>
                            <option value="KEBONSARI" data-idunitkerja="90" >PKM KEBONSARI</option>
                            <option value="BANGKINGAN" data-idunitkerja="103" >PKM BANGKINGAN</option>
                            <option value="MADE" data-idunitkerja="104" >PKM MADE</option>
                            <option value="MOROKREMBANGAN" data-idunitkerja="117" >PKM MORO KREMBANGAN </option>
                            <option value="TAMBAKWEDI" data-idunitkerja="121" >PKM TAMBAK WEDI</option>
                            <option value="BULAKBANTENG" data-idunitkerja="122" >PKM BULAK BANTENG</option>
                            <option value="KEPUTIH" data-idunitkerja="135" >PKM KEPUTIH</option>
                            <option value="KALIJUDAN" data-idunitkerja="138" >PKM KALIJUDAN</option>
                            <option value="BALASKLUMPRIK" data-idunitkerja="148" >PKM BALAS KLUMPRIK</option>
                            <option value="SIWALANKERTO" data-idunitkerja="151" >PKM SIWALANKERTO</option>
                            <option value="SAWAHPULO" data-idunitkerja="984" >PKM SAWAH PULO</option>
                        </optgroup>
                    </select>
                </div>
                <div class="h-100 d-inline-block">
                    <input id="tagsinput" hidden type="text" value="" class="tagsinput" data-role="tagsinput" data-size="md" data-color="info" data-role="filter">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="saldotable" width="100%" cellspacing="0">
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
<script type="text/javascript">
var oIdunitkerja;
var oUnitkerja;
$(document).ready(function(){
    //tambahkan swal pada set isall
    $('#isall').change(function(e){
        var self=this;
        if(self.checked){
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger mr-2',
                    cancelButton: 'btn btn-dark'
                },
                buttonsStyling: false,
                icon: 'warning',
                iconColor: '#f4b619',
                title: 'Yakin appli ke semua PKM?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed === false) {
                    self.checked=false;
                }
            })
        }
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
        values.forEach(function(s, i){
            var label=$(selectContainer[0].selectedOptions[i]).closest('optgroup').prop('label');            
            oIdunitkerja=selectContainer[0].selectedOptions[i].dataset.idunitkerja;
            oUnitkerja=s;
            tagContainer.tagsinput('add', s);
            fetchtable(oIdunitkerja);        // fetch for table
        });
    });
    // END: Section of Filter 

    function fetchtable(idunitkerja){
        if ($.fn.dataTable.isDataTable('#saldotable')) {
            oTable.api().clear();
            oTable.api().destroy();
        }

        oTable = $("#saldotable").dataTable({
            processing: true,
            serverSide: true,
            ajax: {type: "POST", url: '{{route("saldo.table", ["idunitkerja" => ''])}}/'+idunitkerja, data:{'_token':@json(csrf_token())}},
            columns: [
                { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' , title:'No.', name:'no'},
                { data:'kode', title:'Kode', name:'kode'},
                { data:'nama', title:'Nama', name:'nama'},
                { data:'anggaran', title:'Anggaran', name:'anggaran'},
                { data:'realisasi', title:'Realisasi', name:'realisasi'},
                { data:'edit', name:'edit', title:'Aksi', orderable: false, searchable: false, width:1},
                { data:'action', name:'action', orderable: false, searchable: false, width:1},
            ],
        });

        $('#saldocontainer').attr('hidden',false);
    }
    
});

function show(self){
    var tr = $(self).closest('tr');
    var row = oTable.api().row( tr );
    var data=oTable.fnGetData(tr);
    var btn=tr.find('td .dt-control');

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        btn.removeClass('btn-outline-danger');
        btn.addClass('btn-outline-success');
        btn.html('<i class="fas fa-plus fa-md"></i>')
    }
    else {
        row.child( format(data)).show();
        btn.addClass('btn-outline-danger');
        btn.removeClass('btn-outline-success');
        btn.html('<i class="fas fa-minus fa-md"></i>')
    }
}

function format(data){
    var detailstr = data.saldo.reduce(function(e,i){
        return e+='<tr><td>'+moment(i['tanggal']).format('MMM YYYY')+'</td><td>'+i['saldo']+'</td><td>'+(i['tipe']?i['tipe']:'-')+'</td></tr>';
    },'');

    if(detailstr===''){
        detailstr='<tr><td colspan="3" class="text-center">kosong</td></tr>'
    }

    var str='<tr><td></td>'+
    '<td colspan="6">'+
    `<table class="table">
        <thead>
            <tr><th><b>Bulan</b></th><th><b>Nominal</b></th><th><b>Tipe</b></th></tr>
        </thead>
        <tbody>
        ${detailstr}
        </tbody>
    </table>`
    '</td></tr>';
            
    var $view=$(str);

    return $view;
}

function tambah(self){
    var $modal=$('#tambah');
    var tr = $(self).closest('tr');
    var row = oTable.api().row( tr );
    var data=oTable.fnGetData(tr);
    console.log(data);
    // $modal.find('input[name=id]').val(data['ID']);
    let saldolen = data.saldo.length;
    $modal.find('input[name=saldo]').val(data['anggaran']);
    $modal.find('input[name=idrekening]').val(data['id']);
    $modal.find('input[name=koderekening]').val(data['kode']).prop('readonly', true);
    $modal.find('input[name=namarekening]').val(data['nama']).prop('readonly', true);
    $modal.find('input[name=idunitkerja]').val(oIdunitkerja);
    $modal.find('#tambahLabel').html('Ubah Saldo <b>'+oUnitkerja+'</b>')
    $modal.modal('show');
}
</script>
@endsection