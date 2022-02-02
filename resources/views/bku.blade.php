@extends('layouts.layout')

@section('bkuStatus')
active
@endsection

@php
$role = Auth::user()->id;
@endphp

@section('content')
<!-- Modal Tambah BKU -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah BKU" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah BKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bku.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit BKU -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting BKU" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Sunting BKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bku.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transaksi To BKU -->
<div class="modal modal-danger fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="Cetak BKU" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak BKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="cetakForm">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Puskesmas</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idunitkerja" required>
                            @if( in_array($role,['PKM']) )
                                @foreach($unitkerja as $uk)
                                <option value="">--Pilih--</option>
                                <option value="{{$uk->id}}">{{$uk->nama.', '.$uk->nama_alias}}</option>
                                @endforeach
                            @else
                                <option value="">--Pilih--</option>
                                <option value="38">Puskesmas Tanjungsari, TANJUNGSARI</option>
                                <option value="39">Puskesmas Simomulyo, SIMOMULYO</option>
                                <option value="40">Puskesmas Manukan Kulon, MANUKANKULON</option>
                                <option value="41">Puskesmas Balongsari, BALONGSARI</option>
                                <option value="42">Puskesmas Asemrowo, ASEMROWO</option>
                                <option value="43">Puskesmas Sememi, SEMEMI</option>
                                <option value="44">Puskesmas Benowo, BENOWO</option>
                                <option value="45">Puskesmas Jeruk, JERUK</option>
                                <option value="46">Puskesmas Lidah Kulon, LIDAHKULON</option>
                                <option value="47">Puskesmas Lontar, LONTAR</option>
                                <option value="48">Puskesmas Peneleh, PENELEH</option>
                                <option value="49">Puskesmas Ketabang, KETABANG</option>
                                <option value="50">Puskesmas Kedungdoro, KEDUNGDORO</option>
                                <option value="51">Puskesmas Dr. Soetomo, DRSOETOMO</option>
                                <option value="52">Puskesmas Tembok Dukuh, TEMBOKDUKUH</option>
                                <option value="53">Puskesmas Gundih, GUNDIH</option>
                                <option value="54">Puskesmas Tambakrejo, TAMBAKREJO</option>
                                <option value="55">Puskesmas Simolawang, SIMOLAWANG</option>
                                <option value="56">Puskesmas Perak Timur, PERAKTIMUR</option>
                                <option value="57">Puskesmas Pegirian, PEGIRIAN</option>
                                <option value="58">Puskesmas Sidotopo, SIDOTOPO</option>
                                <option value="59">Puskesmas Wonokusumo, WONOKUSUMO</option>
                                <option value="60">Puskesmas Krembangan Selatan, KREMBANGANSELATAN</option>
                                <option value="61">Puskesmas Dupak, DUPAK</option>
                                <option value="62">Puskesmas Kenjeran, KENJERAN</option>
                                <option value="63">Puskesmas Tanah Kali Kedinding, TAKAL</option>
                                <option value="64">Puskesmas Sidotopo Wetan, SIDOTOPOWETAN</option>
                                <option value="65">Puskesmas Rangkah, RANGKAH</option>
                                <option value="66">Puskesmas Pacar Keling, PACARKELING</option>
                                <option value="67">Puskesmas Gading, GADING</option>
                                <option value="68">Puskesmas Pucangsewu, PUCANGSEWU</option>
                                <option value="69">Puskesmas Mojo, MOJO</option>
                                <option value="70">Puskesmas Kalirungkut, KALIRUNGKUT</option>
                                <option value="71">Puskesmas Medokan Ayu, MEDOKANAYU</option>
                                <option value="72">Puskesmas Tenggilis, TENGGILIS</option>
                                <option value="73">Puskesmas Gunung Anyar, GUNUNGANYAR</option>
                                <option value="74">Puskesmas Menur, MENUR</option>
                                <option value="75">Puskesmas Klampis Ngasem, KLAMPISNGASEM</option>
                                <option value="76">Puskesmas Mulyorejo, MULYOREJO</option>
                                <option value="77">Puskesmas Sawahan, SAWAHAN</option>
                                <option value="78">Puskesmas Putat Jaya, PUTATJAYA</option>
                                <option value="79">Puskesmas Banyu Urip, BANYUURIP</option>
                                <option value="80">Puskesmas Pakis, PAKIS</option>
                                <option value="81">Puskesmas Jagir, JAGIR</option>
                                <option value="82">Puskesmas Wonokromo, WONOKROMO</option>
                                <option value="83">Puskesmas Ngagel Rejo, NGAGELREJO</option>
                                <option value="84">Puskesmas Kedurus, KEDURUS</option>
                                <option value="85">Puskesmas Dukuh Kupang, DUKUHKUPANG</option>
                                <option value="86">Puskesmas Wiyung, WIYUNG</option>
                                <option value="87">Puskesmas Gayungan, GAYUNGAN</option>
                                <option value="88">Puskesmas Jemursari, JEMURSARI</option>
                                <option value="89">Puskesmas Sidosermo, SIDOSERMO</option>
                                <option value="90">Puskesmas Kebonsari, KEBONSARI</option>
                                <option value="103">Puskesmas Bangkingan, BANGKINGAN</option>
                                <option value="104">Puskesmas Made, MADE</option>
                                <option value="117">Puskesmas Moro Krembangan , MOROKREMBANGAN</option>
                                <option value="121">Puskesmas Tambak Wedi, TAMBAKWEDI</option>
                                <option value="122">Puskesmas Bulak Banteng, BULAKBANTENG</option>
                                <option value="135">Puskesmas Keputih, KEPUTIH</option>
                                <option value="138">Puskesmas Kalijudan, KALIJUDAN</option>
                                <option value="148">Puskesmas Balas Klumprik, BALASKLUMPRIK</option>
                                <option value="151">Puskesmas Siwalankerto, SIWALANKERTO</option>
                                <option value="984">Puskesmas Sawah Pulo, SAWAHPULO</option>
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Bulan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="bulan" required>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data BKU</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data BKU</h6>
                </div>
                @if($user->role==='PKM')
                <div class="col text-right dropdown">
                    <div class="btn-group dropleft">
                        <button class="btn btn-sm btn-primary dropdown-toggle dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tambah
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">eSPJ</a>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success ml-1" type="button"   data-toggle="modal" data-target="#cetak" data-placement="top" title="Cetak BKU">
                        Cetak
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="mb-2" style="max-width: 10rem;">
                    <select class="selectpicker" data-none-selected-text="Filter" data-live-search="true" multiple data-show-tick style="max-width: 10rem;" id="filterSelect">
                        <optgroup label="Tipe BKU" data-max-options="1">
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
                <table class="table table-bordered" id="bkutable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th colspan="5" class="text-center">Buku Pembantu</th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
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
$(document).ready(function(){
    function renderTanggal(d,t,row){
        return moment(row['tanggal']).format('L');
    }

    oTable = $("#bkutable").dataTable({
        processing: true,
        serverSide: true,
        order: [[ 1, "desc" ]],
        ajax: {type: "POST", url: '{{route("bku.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' , title:'No.', name:'no'},
            { data:'nomor', title:'No. BKU', name:'nomor'},
            { data:'tanggal', title:'Tanggal', name:'tanggal', render: renderTanggal},
            { data:'jenis', orderable: false , title:'BKU', name:'jenis', className:'text-center'},
            { data:'tipe', orderable: false, width: 1 , title:'UPLS', name:'tipe'},
            { data:'rekening.kode', title:'Rekening', name:'rekening.kode'},
            { data:'KT', orderable: false, width: 1 , title:'KT', name:'KT'},
            { data:'SB', orderable: false, width: 1 , title:'SB', name:'SB'},
            { data:'PNJ', orderable: false, width: 1 , title:'PNJ', name:'PNJ'},
            { data:'PJK', orderable: false, width: 1 , title:'PJK', name:'PJK'},
            { data:'RO', orderable: false, width: 1 , title:'RO', name:'RO'},
            { data:'uraian', orderable: false, width: '23rem', title:'Keperluan', name:'uraian'},
            { data:'nominal', title:'Nominal', name:'nominal'},
            { data:'action', title:'Aksi', name:'action', orderable:false, searchable:false},
        ],
    });

    $('#cetakForm').submit(function(e){
        e.preventDefault();
        let data = my.getFormData($(e.target));
        var alink = document.createElement('a');
        alink.href = "{{route('bku.cetak', ['',''])}}"+'/'+data['idunitkerja']+'/'+data['bulan'];
        alink.target = '_blank';
        alink.click();
    })
})
</script>
@endsection