@extends('layouts.layout')

@section('bukuBankStatus')
active
@endsection

@section('content')
<!-- Modal Tambah BukuBank -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Buku Bank" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Buku Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bukuBank.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Tanggal</b></label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                </div>
                <div class="form-group">
                    <label><b>Uraian Transaksi</b></label>
                    <textarea id="uraian" name="uraian" class="form-control" placeholder="Uraian Transaksi" maxlength="99" rows="3" style="resize: none;" required></textarea>
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
                        <select class="custom-select" id="jenis" name="jenis" style="border-radius:0.35rem 0 0 0.35rem;" required>
                            <option value="" disabled selected>Mutasi</option>
                            <option value="1">Debet</option>
                            <option value="0">Kredit</option>
                        </select>
                    </div>
                    <input type="text" id="nominal" name="nominal" class="form-control" placeholder="Saldo" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
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

<!-- Modal Sunting BukuBank -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Tambah Saldo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Sunting Buku Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bukuBank.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label><b>Tanggal</b></label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                </div>
                <div class="form-group">
                    <label><b>Uraian Transaksi</b></label>
                    <textarea id="uraian" name="uraian" class="form-control" placeholder="Uraian Transaksi" maxlength="99" rows="3" style="resize: none;" required></textarea>
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
                        <select class="custom-select" id="jenis" name="jenis" style="border-radius:0.35rem 0 0 0.35rem;" required>
                            <option value="" disabled selected>Mutasi</option>
                            <option value="1">Debet</option>
                            <option value="0">Kredit</option>
                        </select>
                    </div>
                    <input type="text" id="nominal" name="nominal" class="form-control" placeholder="Saldo" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
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
<form hidden action="{{route('bukuBank.delete')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
    <input type="hidden" name="pkm" value="{{$pkm}}">
    <input type="hidden" name="tanggal" value="{{$bulan}}">
</form>

<!-- Form Update Saldo -->
<div class="modal modal-danger fade" id="updateSaldo" tabindex="-1" role="dialog" aria-labelledby="Update Saldo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Sunting Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bukuBank.updateSaldo')}}" method="POST" id="updateSaldo">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" id=tanggal name="tanggal" value="{{$saldoAwal->tanggal}}">
                <input type="hidden" id="idunitkerja" name="idunitkerja" class="form-control" value="{{$pkm}}" required>
                
                <label><b>Nominal</b></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                    </div>
                    <input type="text" id="nominal" name="nominal" class="form-control" placeholder="Saldo Awal" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
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
                            <button type="submit" class="btn btn-info">Proses</button>
                            <button class="btn btn-success" formaction="">Cetak</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="bukuBankTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" class="ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem; width:110px;">Tanggal</th>
                            <th rowspan="2" class="ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Uraian Transaksi</th>
                            <th rowspan="2" width="1" class="disabled-sorting ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Referensi</th>
                            <th colspan="2" class="text-center ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Mutasi</th>
                            <th rowspan="2" class="text-right disabled-sorting ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Saldo</th>
                            <th rowspan="2" class="text-right disabled-sorting ambil" style="vertical-align:middle; padding:5px 0.75rem 5px 0.75rem;">Aksi</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="padding:5px 0.75rem 5px 0.75rem;">Debit</th>
                            <th class="text-center" style="padding:5px 0.75rem 5px 0.75rem;">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                
                <tr class="bg-dark text-white">
                    @php
                    $jumlah = $saldoAwal->nominal;
                    @endphp
                    <th hidden></th>
                    <th></th>
                    <th colspan="4">Saldo Awal</th>
                    <th class="text-right">{{number_format($saldoAwal->nominal,2,',','.')}} </th>
                    <th class="text-center">
                        @if($saldoAwal->jenis==1)
                        <button onclick="updateSaldo(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Saldo" data-toggle="modal" data-target="#updateSaldo"><i class="fas fa-edit fa-sm"></i></button>
                        @endif
                    </th>
                </tr>
                
                @foreach($bukuBank as $unit)
                <tr>
                    <td hidden>{{$unit->id}}</td>
                    <td hidden>{{$unit->tanggal}}</td>
                    <td hidden>{{$unit->tanggalref}}</td>
                    <td>{{date_format(date_create($unit->tanggal), 'd-m-Y')}}</td>
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
                        {{number_format($jumlah,2,',','.')}}
                    </td>
                    <td class="text-center">
                        <button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Transaksi" data-toggle="modal" data-target="#sunting"><i class="fas fa-edit fa-sm"></i></button>
                        <button onclick="hapus({{$unit->id}})" class="btn btn-sm btn-outline-danger border-0" style="width:2rem;" title="Hapus Transaksi"><i class="fas fa-trash fa-sm"></i></button>
                    </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                    <tr class="bg-dark text-white">
                        <th hidden></th>
                        <th></th>
                        <th colspan="4">Saldo Akhir</th>
                        <th class="text-right">{{number_format($jumlah,2,',','.')}}</th>
                        <th></th>
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
<script>
document.getElementById("filterSelect").value = "{{$pkm}}";

function hapus(id){
    $('#delete').find('input[name=id]').val(id);
    
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

function edit(self){
    var $modal=$('#sunting');
    var tr = $(self).closest('tr');
    var id=tr.find("td:eq(0)").text().trim(); 
    var tanggal=tr.find("td:eq(1)").text().trim(); 
    var tanggalref=tr.find("td:eq(2)").text().trim(); 
    var uraian=tr.find("td:eq(4)").text().trim();
    var noref=tr.find("td:eq(5)").text().trim();
    var debit=tr.find("td:eq(6)").text().trim().replace(/,/g,''); 
    var kredit=tr.find("td:eq(7)").text().trim().replace(/,/g,'');
    
    if(debit=='-'){
        var jenis = 0;
        var nominal = kredit;
    }
    else if(kredit=='-'){
        var jenis = 1;
        var nominal = debit;
    }
    
    $modal.find('input[name=id]').val(id);
    $modal.find('input[name=noref]').val(noref);
    $modal.find('input[name=tanggalref]').val(tanggalref);
    $modal.find('input[name=tanggal]').val(tanggal);
    $modal.find('select[name=jenis]').val(jenis).change();
    $modal.find('textarea[name=uraian]').val(uraian);
    $modal.find('input[name=nominal]').val(nominal);
}

function updateSaldo(self){
    var $modal=$('#updateSaldo');
    var jenis = 0;
    
    $modal.find('input[name=tanggal]').val('{{$saldoAwal->tanggal}}');
    $modal.find('input[name=nominal]').val('{{$saldoAwal->nominal}}');
}
$(function () {
    $('#datetimepicker').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY',
    });
});
$(function () {
    $('#datetimepicker1').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY',
    });
});

</script>
@endsection