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
                <h5 class="modal-title" id="tambahLabel">Tambah Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('saldo.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Nama</b></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label><b>Alamat</b></label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
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
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Saldo</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('saldo')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="d-block"><b>Unit Kerja</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idunitkerja" required >
                            <option value="">--Pilih--</option>
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
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label class="d-block"><b>Subkegiatan</b></label>
                        <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idgrup" required >
                            <option value="">--Pilih--</option>
                            @foreach($subkegiatan as $sk)
                            <option value="{{$sk->idgrup}}">{{$sk->kode.', '.$sk->nama.', '.$sk->tahun}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-sm btn-success" data-placement="top" title="Filter">Filter</button>        
            </div>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    @if(isset($saldos))
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Histori Saldo</h6>
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
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Saldo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Saldo</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12 Januari 2021</td>
                            <th>Inisial</th>
                            <td>12.000.000</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-primary border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>15 Februari 2021</td>
                            <th></th>
                            <td>7.000.000</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-primary border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>25 Maret 2021</td>
                            <th></th>
                            <td>2.000.000</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-primary border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>27 Maret 2021</td>
                            <th>Revisi</th>
                            <td>42.000.000</td>
                            <td>
                                <button onclick="edit(this)" class="btn btn-sm btn-outline-primary border-0" data-toggle="modal" data-target="#sunting" data-placement="top" title="sunting"><i class="fas fa-edit fa-sm"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- /.container-fluid -->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    @if(isset($input))
    const input = @json($input);
    $('select[name=idunitkerja]').val(input['idunitkerja']).change();
    $('select[name=idgrup]').val(input['idgrup']).change();
    @endif
});
</script>
@endsection