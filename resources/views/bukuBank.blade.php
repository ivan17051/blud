@extends('layouts.layout')

@section('bukuBankStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Saldo -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Saldo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Buku Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bukuBank.create')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Tanggal</b></label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                </div>
                <div class="form-group">
                    <label><b>Uraian Transaksi</b></label>
                    <textarea id="uraian" name="uraian" class="form-control" placeholder="Uraian Transaksi" maxlength="99" rows="3" style="resize: none;"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>No. Referensi</b></label>
                            <input type="text" id="noref" name="noref" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Tanggal Referensi</b></label>
                            <input type="date" id="tanggalref" name="tanggalref" class="form-control">
                        </div>
                    </div>
                </div>
                <label><b>Nominal</b></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="custom-select" id="mutasi" name="mutasi" style="border-radius:0.35rem 0 0 0.35rem;">
                            <option value="" disabled selected>Mutasi</option>
                            <option value="1">Debet</option>
                            <option value="0">Kredit</option>
                        </select>
                    </div>
                    <input type="text" id="saldo" name="saldo" class="form-control" placeholder="Saldo" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
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
    <h1 class="h3 mb-2 text-gray-800">Data Buku Bank</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <div class="card shadow mb-4" id="saldocontainer">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Buku Bank</h6>
                </div>
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
            <form action="{{url('/bukuBank')}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="mb-3">
                            <select class="selectpicker" data-live-search="true" id="filterSelect" name="PKM" required>
                                @php
                                $user = Auth::user();
                                @endphp
                                @if($user->role=='PKM')
                                <option value="{{$user->idunitkerja}}">PKM {{$user->nama}}</option>
                                @else
                                <option>
                                    <option value="38" >PKM TANJUNGSARI</option>
                                    <option value="39" >PKM SIMOMULYO</option>
                                    <option value="40" >PKM MANUKAN KULON</option>
                                    <option value="41" >PKM BALONGSARI</option>
                                    <option value="42" >PKM ASEMROWO</option>
                                    <option value="43" >PKM SEMEMI</option>
                                    <option value="44" >PKM BENOWO</option>
                                    <option value="45" >PKM JERUK</option>
                                    <option value="46" >PKM LIDAH KULON</option>
                                    <option value="47" >PKM LONTAR</option>
                                    <option value="48" >PKM PENELEH</option>
                                    <option value="49" >PKM KETABANG</option>
                                    <option value="50" >PKM KEDUNGDORO</option>
                                    <option value="51" >PKM DR. SOETOMO</option>
                                    <option value="52" >PKM TEMBOK DUKUH</option>
                                    <option value="53" >PKM GUNDIH</option>
                                    <option value="54" >PKM TAMBAKREJO</option>
                                    <option value="55" >PKM SIMOLAWANG</option>
                                    <option value="56" >PKM PERAK TIMUR</option>
                                    <option value="57" >PKM PEGIRIAN</option>
                                    <option value="58" >PKM SIDOTOPO</option>
                                    <option value="59" >PKM WONOKUSUMO</option>
                                    <option value="60" >PKM KREMBANGAN SELATAN</option>
                                    <option value="61" >PKM DUPAK</option>
                                    <option value="62" >PKM KENJERAN</option>
                                    <option value="63" >PKM Tanah KALI KEDINDING</option>
                                    <option value="64" >PKM SIDOTOPO WETAN</option>
                                    <option value="65" >PKM RANGKAH</option>
                                    <option value="66" >PKM PACAR KELING</option>
                                    <option value="67" >PKM GADING</option>
                                    <option value="68" >PKM PUCANGSEWU</option>
                                    <option value="69" >PKM MOJO</option>
                                    <option value="70" >PKM KALIRUNGKUT</option>
                                    <option value="71" >PKM MEDOKAN AYU</option>
                                    <option value="72" >PKM TENGGILIS</option>
                                    <option value="73" >PKM GUNUNG ANYAR</option>
                                    <option value="74" >PKM MENUR</option>
                                    <option value="75" >PKM KLAMPIS NGASEM</option>
                                    <option value="76" >PKM MULYOREJO</option>
                                    <option value="77" >PKM SAWAHAN</option>
                                    <option value="78" >PKM PUTAT JAYA</option>
                                    <option value="79" >PKM BANYU URIP</option>
                                    <option value="80" >PKM PAKIS</option>
                                    <option value="81" >PKM JAGIR</option>
                                    <option value="82" >PKM WONOKROMO</option>
                                    <option value="83" >PKM NGAGEL REJO</option>
                                    <option value="84" >PKM KEDURUS</option>
                                    <option value="85" >PKM DUKUH KUPANG</option>
                                    <option value="86" >PKM WIYUNG</option>
                                    <option value="87" >PKM GAYUNGAN</option>
                                    <option value="88" >PKM JEMURSARI</option>
                                    <option value="89" >PKM SIDOSERMO</option>
                                    <option value="90" >PKM KEBONSARI</option>
                                    <option value="103" >PKM BANGKINGAN</option>
                                    <option value="104" >PKM MADE</option>
                                    <option value="117" >PKM MORO KREMBANGAN </option>
                                    <option value="121" >PKM TAMBAK WEDI</option>
                                    <option value="122" >PKM BULAK BANTENG</option>
                                    <option value="135" >PKM KEPUTIH</option>
                                    <option value="138" >PKM KALIJUDAN</option>
                                    <option value="148" >PKM BALAS KLUMPRIK</option>
                                    <option value="151" >PKM SIWALANKERTO</option>
                                    <option value="984" >PKM SAWAH PULO</option>
                                </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-2" style="padding-left:0;">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" readonly name="bulan" value="{{$bulan}}" required>
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="padding-left:0;">
                        <div class="mb-2" style="max-width: 10rem;">
                            <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="saldotable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" data-priority="1" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem; width:110px;">Tanggal</th>
                            <th rowspan="2" data-priority="3" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Uraian Transaksi</th>
                            <th rowspan="2" data-priority="1" width="1" class="disabled-sorting" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Referensi</th>
                            <th colspan="2" data-priority="3" class="text-center" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Mutasi</th>
                            <th rowspan="2" data-priority="1" class="text-right disabled-sorting" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Saldo</th>
                        </tr>
                        <tr>
                            <th data-priority="2" class="text-center" style="padding:5px 0.75rem 5px 0.75rem;">Debit</th>
                            <th data-priority="2" class="text-center" style="padding:5px 0.75rem 5px 0.75rem;">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                
                <tr class="bg-dark text-white">
                    @php
                    $saldoAwal = 0;
                    $jumlah = $saldoAwal;
                    @endphp
                    <th></th>
                    <th colspan="4">Saldo Awal</th>
                    <th class="text-right">{{number_format($saldoAwal,2,',','.')}} </th>
                </tr>
                
                @foreach($bukuBank as $unit)
                <tr>
                    <td>{{date_format(date_create($unit->tanggal), "d-m-Y")}}</td>
                    <td>{{$unit->uraian}}</td>
                    <td>{{$unit->noref}}</td>
                    <td class="text-right">
                        @if($unit->jenis==1)
                        {{number_format($unit->nominal,2)}}
                        @php
                        $jumlah += $unit->nominal;
                        @endphp
                        @else - 
                        @endif</td>
                    <td class="text-right">
                        @if($unit->jenis==0)
                        {{number_format($unit->nominal,2)}}
                        @php
                        $jumlah -= $unit->nominal;
                        @endphp
                        @else - 
                        @endif</td>
                    <td class="text-right">
                        {{number_format($jumlah,2,',','.')}}</td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                    <tr class="bg-dark text-white">
                        <th></th>
                        <th colspan="4">Saldo Akhir</th>
                        <th class="text-right">{{number_format($jumlah,2,',','.')}}</th>
                    </tr>
                </tfoot>
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

document.getElementById("filterSelect").value = "{{$pkm}}";
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

    $(function () {
        $('#datetimepicker1').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY',
        });
    });

</script>
@endsection