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
    <div class="modal-dialog modal-lg" role="document">
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
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="d-block"><b>Unit Kerja</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idunitkerja" required>
                            @if( in_array($role,['admin','PIH']) )
                                <option value="">--Pilih--</option>
                                <option value="1">Dinas Kesehatan Kota Surabaya, DKK</option>
                                <option value="2">Bagian Sekretariat, SEKRETARIAT</option>
                                <option value="3">Sub. Bag. Penyusunan Program, SUNGRAM</option>
                                <option value="4">Sub. Bag. Tata Usaha, TU</option>
                                <option value="5">UNIT PEGAWAIAN, UP</option>
                                <option value="6">Sub. Bag. Keuangan dan Perlengkapan, KEUANGAN</option>
                                <option value="7">INFORMASI TEKNOLOGI, IT</option>
                                <option value="8">SISTEM INFORMASI KESEHATAN, SIK</option>
                                <option value="9">PERIJINAN, PERIJINAN</option>
                                <option value="10">KONSULTAN, KONSULTAN</option>
                                <option value="11">GUDANG, GUDANG</option>
                                <option value="12">PERPUSTAKAAN, PERPUSTAKAAN</option>
                                <option value="13">SEKPRO, SEKPRO</option>
                                <option value="14">AMBULAN, AMBULAN</option>
                                <option value="15">KEAMANAN, KEAMANAN</option>
                                <option value="16">SEKRETARIS DINAS,SEKRETARIS  DINAS</option>
                                <option value="17">Bidang Pelayanan Kesehatan, YANKES</option>
                                <option value="18">Seksi Pelayanan Kesehatan Dasar, YANKESDAS</option>
                                <option value="19">Seksi Pelayanan Kesehatan Khusus, YANKESKHUSUS</option>
                                <option value="20">Seksi Pelayanan Kesehatan Rujukan, YANKESRUJUKAN</option>
                                <option value="21">Bidang Pengembangan SDM Kesehatan, PSDMK</option>
                                <option value="22">Seksi Perencanaan dan Pendayagunaan SDM Kesehatan, PSDMPERENCANAAN</option>
                                <option value="23">Seksi Pendidikan dan Pelatihan SDM Kesehatan, PSDMPENDIDIKAN</option>
                                <option value="24">Seksi Registrasi dan Akreditasi SDM Kesehatan, PSDMREGISTRASI</option>
                                <option value="25">Bidang Jaminan Dan Sarana Kesehatan, JAMSARKES</option>
                                <option value="26">Seksi Jaminan Kesehatan, JAMKESMAS</option>
                                <option value="27">Seksi Kefarmasian, FARMASI</option>
                                <option value="28">Seksi Sarana dan Peralatan Kesehatan, SARALKES</option>
                                <option value="30">Bidang Pengendalian Masalah Kesehatan, PMK</option>
                                <option value="31">Seksi Pengendalian dan Pemberantasan Penyakit, P2P</option>
                                <option value="32">Seksi Wabah dan Bencana, WABEN</option>
                                <option value="33">Seksi Kesehatan Lingkungan, KESLING</option>
                                <option value="34">IMUNISASI, IMUNISASI</option>
                                <option value="35">PONDOK ASI,PONDOK  ASI</option>
                                <option value="37">Laboratorium Kesehatan Daerah Kota Surabaya,LAB  DKK</option>
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
                            @else
                                @foreach($unitkerja as $uk)
                                <option value="">--Pilih--</option>
                                <option value="{{$uk->id}}">{{$uk->nama.', '.$uk->nama_alias}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Nama</b></label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>NIK</b></label>
                            <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" maxlength=16 required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>NIP</b></label>
                            <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" maxlength=18 required>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <input type="text" id="rekening" name="rekening" class="form-control" placeholder="Rekening" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Golongan</b></label>
                            <input type="text" id="golongan" name="golongan" class="form-control" placeholder="Golongan" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jabatan</b></label>
                            <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" >
                        </div>
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

<!-- Modal Sunting Pejabat -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting Rekanan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="d-block"><b>Unit Kerja</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idunitkerja" required>
                        @if( in_array($role,['admin','PIH']) )
                            <option value="">--Pilih--</option>
                            <option value="1">Dinas Kesehatan Kota Surabaya, DKK</option>
                            <option value="2">Bagian Sekretariat, SEKRETARIAT</option>
                            <option value="3">Sub. Bag. Penyusunan Program, SUNGRAM</option>
                            <option value="4">Sub. Bag. Tata Usaha, TU</option>
                            <option value="5">UNIT PEGAWAIAN, UP</option>
                            <option value="6">Sub. Bag. Keuangan dan Perlengkapan, KEUANGAN</option>
                            <option value="7">INFORMASI TEKNOLOGI, IT</option>
                            <option value="8">SISTEM INFORMASI KESEHATAN, SIK</option>
                            <option value="9">PERIJINAN, PERIJINAN</option>
                            <option value="10">KONSULTAN, KONSULTAN</option>
                            <option value="11">GUDANG, GUDANG</option>
                            <option value="12">PERPUSTAKAAN, PERPUSTAKAAN</option>
                            <option value="13">SEKPRO, SEKPRO</option>
                            <option value="14">AMBULAN, AMBULAN</option>
                            <option value="15">KEAMANAN, KEAMANAN</option>
                            <option value="16">SEKRETARIS DINAS,SEKRETARIS  DINAS</option>
                            <option value="17">Bidang Pelayanan Kesehatan, YANKES</option>
                            <option value="18">Seksi Pelayanan Kesehatan Dasar, YANKESDAS</option>
                            <option value="19">Seksi Pelayanan Kesehatan Khusus, YANKESKHUSUS</option>
                            <option value="20">Seksi Pelayanan Kesehatan Rujukan, YANKESRUJUKAN</option>
                            <option value="21">Bidang Pengembangan SDM Kesehatan, PSDMK</option>
                            <option value="22">Seksi Perencanaan dan Pendayagunaan SDM Kesehatan, PSDMPERENCANAAN</option>
                            <option value="23">Seksi Pendidikan dan Pelatihan SDM Kesehatan, PSDMPENDIDIKAN</option>
                            <option value="24">Seksi Registrasi dan Akreditasi SDM Kesehatan, PSDMREGISTRASI</option>
                            <option value="25">Bidang Jaminan Dan Sarana Kesehatan, JAMSARKES</option>
                            <option value="26">Seksi Jaminan Kesehatan, JAMKESMAS</option>
                            <option value="27">Seksi Kefarmasian, FARMASI</option>
                            <option value="28">Seksi Sarana dan Peralatan Kesehatan, SARALKES</option>
                            <option value="30">Bidang Pengendalian Masalah Kesehatan, PMK</option>
                            <option value="31">Seksi Pengendalian dan Pemberantasan Penyakit, P2P</option>
                            <option value="32">Seksi Wabah dan Bencana, WABEN</option>
                            <option value="33">Seksi Kesehatan Lingkungan, KESLING</option>
                            <option value="34">IMUNISASI, IMUNISASI</option>
                            <option value="35">PONDOK ASI,PONDOK  ASI</option>
                            <option value="37">Laboratorium Kesehatan Daerah Kota Surabaya,LAB  DKK</option>
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
                        @else
                            @foreach($unitkerja as $uk)
                            <option value="">--Pilih--</option>
                            <option value="{{$uk->id}}">{{$uk->nama.', '.$uk->nama_alias}}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Nama</b></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>NIK</b></label>
                            <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>NIP</b></label>
                            <input type="text" name="nip" class="form-control" placeholder="NIP" required>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <input type="text" name="rekening" class="form-control" placeholder="Rekening" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Golongan</b></label>
                            <input type="text" name="golongan" class="form-control" placeholder="Golongan" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jabatan</b></label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" >
                        </div>
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
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

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
                            <th hidden>idunitkerja</th>
                            <th hidden>ID</th>
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
                            <th hidden>idunitkerja</th>
                            <th hidden>ID</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($pejabat as $unit)
                        <tr>
                            <td>{{$unit->nama}}</td>
                            <td>{{$unit->nip}}</td>
                            <td>{{$unit->jabatan}}</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                                <button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>
                            </td>
                            <td hidden>{{$unit->nik}}</td>
                            <td hidden>{{$unit->golongan}}</td>
                            <td hidden>{{$unit->rekening}}</td>
                            <td hidden>{{$unit->idunitkerja}}</td>
                            <td hidden>{{$unit->ID}}</td>
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
    
    $modal.find('select[name=idunitkerja]').val(data['idunitkerja']).change();
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