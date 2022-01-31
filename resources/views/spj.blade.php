@extends('layouts.layout')

@section('spjStatus')
active
@endsection

@section('content')

<!-- Modal Tambah SPJ -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Rekanan" aria-hidden="true">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>ID Pekerjaan</b></label>
                            <input type="text" id="kodepekerjaan" name="kodepekerjaan" class="form-control" placeholder="ID Pekerjaan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>ID Transaksi</b></label>
                            <input type="text" id="kodetransasi" name="kodetransaksi" class="form-control" placeholder="ID Transaksi" required>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekanan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idrekanan" required>
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
                            <input type="date" id="tanggalref" name="tanggalref" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Bulan akan di-SPJ kan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="bulanspj" required>
                              <option value="" selected disabled>--Pilih--</option>
                              <option value="01">Januari</option>
                              <option value="02">Februari</option>
                              <option value="03">Maret</option>
                              <option value="04">April</option>
                              <option value="05">Mei</option>
                              <option value="06">Juni</option>
                              <option value="07">Juli</option>
                              <option value="08">Agustus</option>
                              <option value="09">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                    <label><b>Keperluan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keperluan" maxlength="250" rows="3" style="resize: none;" required></textarea>
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
                <h5 class="modal-title" id="suntingLabel">Sunting SPJ</h5>
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
                        @if( in_array($user->role,['admin','PIH']) )
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

function format(data){
    console.log(data);
    //jika ada permintaan revisi, tampilkan pesan
    var pesanerror='';
    if(data.pesanpenolakan && data['status_raw']==="4"){
        pesanerror='<div class="alert alert-danger alert-solid" role="alert"><b>Catatan:</b> '+data.pesanpenolakan+'</div>';
    }
    var rekeningstr = data.rekening.reduce(function(e,i){
        return e+='<tr><td> '+i[1]+' - '+i[2]+'</td><td> '+number_format(i[3],0,',','.')+' </td></tr>';
    },'');

    if(rekeningstr===''){
        rekeningstr='<tr><td class="text-center" colspan=2>Kosong</td><tr>'
    }

    var pajakstr = data.pajak.reduce(function(e,i){
        return e+='<tr><td>'+i[1]+'</td><td>'+i[2]+'</td><td>'+i[4]+'</td><td>'+moment(i[5]).format('L')+'</td><td> '+number_format(i[3],0,',','.')+'</td></tr>';
    },'');

    if(pajakstr===''){
        pajakstr='<tr><td class="text-center" colspan=5>Kosong</td><tr>'
    }

    var potonganstr = data.potongan.reduce(function(e,i){
        return e+='<tr><td>'+i[0]+'</td><td>'+i[1]+'</td><td> '+number_format(i[2],0,',','.')+'</td></tr>';
    },'');
    if(potonganstr===''){
        potonganstr='<tr><td class="text-center" colspan=5>Kosong</td><tr>'
    }

    var tombolubah='<button class="btn btn-sm btn-primary float-right" onclick="ubahRek('+data.id+')" title="Tambah Rekening"><i class="fas fa-plus fa-sm"></i> Tambah</button>';
    var tombolubahPajak='<button class="btn btn-sm btn-primary float-right" onclick="ubahPajak('+data.id+')" title="Tambah Rekening"><i class="fas fa-plus fa-sm"></i> Tambah</button>';
    var tombolubahPotongan='<button class="btn btn-sm btn-primary float-right" onclick="ubahPotongan('+data.id+')" title="Tambah Potongan"><i class="fas fa-plus fa-sm"></i> Tambah</button>';

    //pastikan tombol ubah tidak ada untuk transaksi yg sedang diajukan sp2d nya atau sudah disetujui
    if(data['status_raw']==='2' || data['status_raw']==='3'){
        tombolubah='';
        tombolubahPajak='';
        tombolubahPotongan='';
    }

    @if($user->role !== 'PKM')
    tombolubah='';
    tombolubahPajak='';
    tombolubahPotongan='';
    @endif

    var str='<tr><td></td><td colspan="'+ @if(in_array($user->role,['PKM'])) '12' @elseif(in_array($user->role,['KEU'])) '9' @else '8' @endif +'" style="bacground-color:#f9f9f9;">'+pesanerror+
    `<ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab1" data-toggle="tab" href="#rekening_${data.id}" role="tab" aria-controls="rekening_${data.id}" aria-selected="true">Rekening</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#pajak_${data.id}" role="tab" aria-controls="pajak_${data.id}" aria-selected="false">Informasi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#potongan_${data.id}" role="tab" aria-controls="potongan_${data.id}" aria-selected="false">Potongan</a>
        </li>
    </ul>`+
    '<div class="tab-content" id="myTabContent">'+
        `<div class="tab-pane fade show active" id="rekening_${data.id}" role="tabpanel" aria-labelledby="rekening_${data.id}"><table class="table">
            <thead>
                <tr><th width="70%"><b>Rekening</b></th><th><b>Jumlah</b></th></tr>
            </thead>
            <tbody>`+rekeningstr+
            `<tbody>  
            </table>`+tombolubah+'</div>'+
        `<div class="tab-pane fade" id="pajak_${data.id}" role="tabpanel" aria-labelledby="pajak_${data.id}">
            <table class="table">
                <thead>
                    <tr><th><b>Kode</b></th><th><b>Nama</b></th><th><b>Kode Billing</b></th><th><b>Kadaluarsa</b></th><th><b>Nominal</b></th></tr>
                </thead>
                <tbody>
                ${pajakstr}
                </tbody>
            </table>
            ${tombolubahPajak}
        </div>`+
        `<div class="tab-pane fade" id="potongan_${data.id}" role="tabpanel" aria-labelledby="potongan_${data.id}">
        <table class="table">
                <thead>
                    <tr><th><b>Kode</b></th><th><b>Nama Potongan</b></th><th><b>Nominal</b></th></tr>
                </thead>
                <tbody>
                ${potonganstr}
                </tbody>
            </table>
            ${tombolubahPotongan}
        </div>`+
    '</div>'+
    '</td></tr>';
            
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
  
    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {type: "POST", url: '{{route("spj.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' , title:'No.', name:'no'},
            { data:'tanggalref', title:'Tanggal', name:'tanggalref'},
            { data:'nama',orderable: false, title:'Subkegiatan', name:'subkegiatan.nama'},
            { data:'nomor', title:'Nomor', name:'nomor'},
            { data:'nomor', title:'Nomor', name:'nomor'},
            { data:'nomor', title:'Nomor', name:'nomor'},
            { data:'nomor', title:'Nomor', name:'nomor'},
            { data:'nomor', title:'Nomor', name:'nomor'},
            { data:'keterangan', orderable: false, width: '23rem', title:'Keperluan', name:'keterangan'},
            @if(in_array($user->role,['PKM']))
            { data:'action', orderable: false, searchable: false, className: "text-right", width: '4rem', title:'Aksi', name:'aksi'},
            @endif
            { data:'unitkerja.nama', visible: false, name:'unitkerja.nama'},
            { data:'status_raw', visible: false, name:'status'},
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
                    oTable.api().column('unitkerja.nama:name').search( s , true, false)
                    break;
            }
        });
        oTable.api().draw();    // filter tabel
    });
    // END: Section of Filter 

});
</script>
@endsection