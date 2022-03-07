@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@php
$role = Auth::user()->id;
@endphp

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
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idsubkegiatan" required >
                        <option value="">--Pilih--</option>
                        @foreach($subkegiatan as $sk)
                        <option value="{{$sk->id}}">{{$sk->kode.', '.$sk->nama}}</option>
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
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan" maxlength="250" rows="3" style="resize: none;" required></textarea>
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

<!-- Modal Edit Transaksi -->
<div class="modal modal-danger fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="Sunting Transaksi" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Sunting Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" name=id>
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
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input readonly type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="tanggalref" required/>
                                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Subkegiatan</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idsubkegiatan" required >
                        <option value="">--Pilih--</option>
                        @foreach($subkegiatan as $sk)
                        <option value="{{$sk->id}}">{{$sk->kode.', '.$sk->nama}}</option>
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
                    <input type="hidden" name="saldo">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>SubRekening</b></label>
                                <select class="selectpicker" data-style-base="form-control" data-live-search="true" data-style="" name="tipe" required onchange="infoSaldo(this, '#infosaldotarget')">
                                    <option value="">--Pilih--</option>
                                    @foreach($rekening as $unit)
                                    <option value="{{$unit->id}}_{{$unit->nama}}" data-saldo="{{$unit->saldo->isEmpty() ? 0 : $unit->saldo->first()->saldo }}">{{$unit->kode}} - {{$unit->nama}}</option>
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
                            <div class="float-right text-right">
                                <p id="infosaldotarget"></p>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{route('transaksi.update')}}" method="POST" id="daftarrekening">
                    <input type="hidden" name="id">
                    <input type="hidden" name="comment" value="daftarrekening">
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

<!-- Modal Ubah Pajak -->
<div class="modal modal-danger fade" id="ubahPajak" tabindex="-1" role="dialog" aria-labelledby="Tambah Pajak" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahLabel">Tambah Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="GET" id="addpajak">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Pajak</b></label>
                                <select class="selectpicker" data-style-base="form-control" data-live-search="true" data-style="" name="tipe" required>
                                    <option value="">--Pilih--</option>
                                    @foreach($pajak as $unit)
                                    <option value="{{$unit->id}}_{{$unit->nama}}">{{$unit->kode.' - '.$unit->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Nominal</b></label>
                                <input type="text" name="nominal" class="form-control" placeholder="Nominal" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Kode Billing</b></label>
                                <input type="text" name="kodebilling" class="form-control" placeholder="Kode Billing" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Tanggal Kadaluarsa</b></label>
                                <div class="input-group date" id="tanggalkadaluarsa" data-target-input="nearest">
                                    <input readonly type="text" class="form-control datetimepicker-input" data-target="#tanggalkadaluarsa" name="tanggalkadaluarsa" required/>
                                    <div class="input-group-append" data-target="#tanggalkadaluarsa" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
                        </div>
                    </div>
                </form>
                <form action="{{route('transaksi.update')}}" method="POST" id="daftarpajak">
                    <input type="hidden" name="id">
                    <input type="hidden" name="comment" value="daftarpajak">
                    @csrf
                    @method('PUT')
                    <table class="table" id="pajaktable">
                        <thead>
                            <tr>
                                <th>Pajak</th>
                                <th>Kode Billing</th>
                                <th>Kadaluarsa</th>
                                <th>Nominal</th>
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
                <button type="button" onclick="$('#daftarpajak').submit()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Potongan -->
<div class="modal modal-danger fade" id="ubahPotongan" tabindex="-1" role="dialog" aria-labelledby="Tambah Potongan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahLabel">Tambah Potongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="GET" id="addpotongan">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Kode</b></label>
                                <input type="text" name="kode" class="form-control" placeholder="Kode" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Nama Potongan</b></label>
                                <input type="text" name="potongan" class="form-control" placeholder="Nama Potongan" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label><b>Nominal</b></label>
                                <input type="text" name="nominal" class="form-control" placeholder="Nominal" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
                        </div>
                    </div>
                </form>
                <form action="{{route('transaksi.update')}}" method="POST" id="daftarpotongan">
                    <input type="hidden" name="id">
                    <input type="hidden" name="comment" value="daftarpotongan">
                    @csrf
                    @method('PUT')
                    <table class="table" id="potongantable">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Potongan</th>
                                <th>Nominal</th>
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
                <button type="button" onclick="$('#daftarpotongan').submit()" class="btn btn-primary">Simpan</button>
            </div>
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
            <!-- <div class="modal-body">
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
                        @if($p->jabatan == 'Bendahara Pengeluaran')
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>  
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">SPP</button>
                <button type="submit" id="cetaksppup" class="btn btn-info" formaction="">Rincian</button>
                <button type="button" id="viewCeklist" class="btn btn-success" onclick="showCeklist(this)" value="" data-cek="" data-toggle="modal" data-target="#ceklist">Ceklist</button>
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
            <!-- <div class="modal-body">
                <div class="form-group">
                    <label><b>Bendahara</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idbendahara" required >
                        <option value="">--Pilih--</option>
                        @foreach($pejabat as $p)
                        @if($p->jabatan=='Bendahara Pengeluaran')
                        <option value="{{$p->id}}">{{$p->nama.', '.$p->nip}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>  
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">SPM</button>
                <button type="submit" id="cetaksptb" class="btn btn-info" formaction="">SPTB</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cetak sp2d Transaksi -->
<div class="modal modal-danger fade" id="cetaksp2d" tabindex="-1" role="dialog" aria-labelledby="Cetak SPD" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="" method="GET" target="_blank">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Cetak SP2D</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transaksi To BKU -->
<div class="modal modal-danger fade" id="transaksiToBKU" tabindex="-1" role="dialog" aria-labelledby="Tambah Potongan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaksiToBKULabel">Transaksi To BKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bku.transaksi2bku')}}" method="POST" id="transaksiToBKUForm">
            @csrf
            <input type="hidden" name="idtransaksi">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Buku Pembantu</b></label>
                    <div id="bukupembantu">
                        <div class="form-check mb-2 mr-2 d-inline-block">
                            <input class="form-check-input" value="1" id="KT" name="KT" type="checkbox" >
                            <label class="form-check-label" for="KT">Kas Tunai</label>
                        </div>
                        <div class="form-check mb-2 mr-2 d-inline-block">
                            <input class="form-check-input" value="1" id="SB" name="SB" type="checkbox" >
                            <label class="form-check-label" for="SB">Simpanan Bank</label>
                        </div>
                        <div class="form-check mb-2 mr-2 d-inline-block">
                            <input class="form-check-input" value="1" id="PNJ" name="PNJ" type="checkbox" >
                            <label class="form-check-label" for="PNJ">Panjar</label>
                        </div>
                        <div class="form-check mb-2 mr-2 d-inline-block">
                            <input class="form-check-input" value="1" id="RO" name="RO" type="checkbox" >
                            <label class="form-check-label" for="RO">Rincian Objek</label>
                        </div>
                        <!-- <div class="form-check mb-2 mr-2 d-inline-block" hidden>
                            <input class="form-check-input" id="PJK" name="PJK" type="checkbox" >
                            <label class="form-check-label" for="PJK">Pajak</label>
                        </div> -->
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pilih Universal -->
<div class="modal modal-danger fade" id="pilihSpp" tabindex="-1" role="dialog" aria-labelledby="Pilih Universal" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pilihSppLabel">Pilih SPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="spptable" width="100%" cellspacing="0">
                    <thead>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="pilih_multi()">Pilih</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tarik e-SPJ LS menjadi SPP LS -->
<div class="modal modal-danger fade" id="tarik_eSPJ_LS" tabindex="-1" role="dialog" aria-labelledby="Tarik e-SPJ LS" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarik_eSPJ_LSLabel">Tarik e-SPJ LS </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.espj2transaksi')}}" method="post" onsubmit="return submit_espj_ls(event);">
                @csrf
                <input type="hidden" name="currentIdTransaksi">
                <input type="hidden" name="idtransaksi">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>ID Transaksi</b></label>
                    <div class="input-group">
                        <input readonly type="text" pattern="[0-9]{1,7}" name="kodetransaksi" class="form-control" placeholder="ID Transaksi" required>
                        <div class="input-group-append">
                        <button class="btn btn-dark" type="button" onclick="$('#pilihSpp').modal({backdrop: 'static', keyboard: false}).modal('show');">?</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tarik LPJ menjadi SPP Baru -->
<div class="modal modal-danger fade" id="tarik_LPJ" tabindex="-1" role="dialog" aria-labelledby="tarik_LPJ" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarik_LPJ">SPP GU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.lpj2transaksi')}}" method="post" onsubmit="return submit_form_tarik_lpj(event);">
                @csrf
                <input type="hidden" name="idlpj">
                <input type="hidden" name="tipe">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Tanggal</b></label>
                            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" name="tanggalref" required/>
                                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><b>Bendahara Pengeluaran</b></label>
                            <select name="idbendahara" class="form-control" required>
                                <option value="">--PILIH--</option>
                                @foreach($pejabat as $e)
                                <option value="{{$e->id}}">{{$e->nama}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label><b>SPD Awal</b></label>
                            <input type="text" class="form-control" readonly value="00009 / (03-01-2022)" />
                        </div>  
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label><b>SPD Akhir</b></label>
                            <input type="text" class="form-control" readonly value="00076 / (24-02-2022)" />
                        </div> 
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label><b>Keperluan</b></label>
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan" maxlength="250" rows="3" style="resize: none;" required></textarea>
                        </div> 
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label><b>ID LPJ</b></label>
                            <div class="input-group">
                                <input readonly type="text" pattern="[0-9]{1,7}" name="nomorlpj" class="form-control" placeholder="Nomor LPJ" required>
                                <div class="input-group-append">
                                <button class="btn btn-dark" type="button" onclick="$('#pilihSpp').modal({backdrop: 'static', keyboard: false}).modal('show');">?</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ceklist -->
<div class="modal modal-danger fade" id="ceklist" tabindex="-1" role="dialog" aria-labelledby="Ceklist" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formCeklist" action="" method="POST" target="_blank">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLabel">Ceklist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idCeklist" name="ceklist" value="">
              <table class="table">
                <tbody id="bodyCeklist"></tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="cetakceklist" class="btn btn-success cetakCeklist" formaction="">Cetak</button>
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
<form hidden action="{{route('transaksi.inputCek')}}" method="POST" id="update" target="_blank">
    @csrf
    @method('put')
    <input type="hidden" name="id">
    <input type="hidden" name="inputCek">
    <input type="hidden" name="inputTglCek">
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
                <div class="col text-right dropdown">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <div class="btn-group dropleft" role="group">
                            <button class="btn btn-sm btn-primary dropdown-toggle dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="pilih_espj_ls()" title="Tambah SPP LS">SPP LS</a>
                                <a class="dropdown-item" href="#" onclick="open_form_tarik_lpj()" title="Tambah SPP GU">SPP GU</a>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary " type="button" data-toggle="modal" data-target="#tambah" data-placement="top" title="Tambah Transaksi">
                            Tambah
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="mb-2" style="max-width: 10rem;">
                    <select class="selectpicker" data-none-selected-text="Filter" data-live-search="true" multiple data-show-tick style="max-width: 10rem;" id="filterSelect">
                        <optgroup label="Status" data-max-options="1">
                            <option value="ACCEPTED">Accepted</option>
                            <option value="SPM TERTOLAK">SPM Tertolak</option>
                            <option value="NEED ACC">Belum Disetujui</option>
                        </optgroup>
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

function showCeklist(self){
    var mainContainer = document.getElementById("bodyCeklist");
    mainContainer.innerHTML = `
        <tr>
            <th scope="row" style="width:5%;"><input type="checkbox" class="sub_chk" data-id="0" ></th>
            <td>Surat Pengantar SPP</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="1"></th>
            <td>Ringkasan SPP</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="2"></th>
            <td>Rincian SPP</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="3"></th>
            <td>Salinan SPD</td>
        </tr>
    `;
    if(self.value=='LS'){
        mainContainer.innerHTML += `
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="4"></th>
            <td>Salinan Surat Rekomendasi dari SKPD teknis terkait</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="5"></th>
            <td>SSP disertai faktur pajak (PPN dan PPh) yang telah ditandatangani wajib pajak dan wajib pungut</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="6"></th>
            <td>Surat perjanjian kerjasama/kontrak antara pengguna anggaran/kuasa pengguna anggaran dengan pihak ketiga serta mencantumkan nomor rekening bank (dibuktikan dengan referensi bank yang diterbitkan pada Tahun Anggaran berkenaan, untuk kepentingan mengikuti pekerjaan di Pemerintah Kota Surabaya) pihak ketiga</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="7"></th>
            <td>Berita Acara penyelesaian pekerjaan</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="8"></th>
            <td>Berita Acara serah terima barang dan jasa</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="9"></th>
            <td>Berita Acara Pembayaran</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="10"></th>
            <td>Kwitansi bermaterai, nota/faktur yang ditandatangani pihak ketiga dan PPTK serta disetujui oleh pengguna anggaran/kuasa pengguna anggaran</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="11"></th>
            <td>Surat jaminan bank atau yang dipersamakan yang dikeluarkan oleh bank atau lembaga keuangan non bank</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="12"></th>
            <td>Dokumen lain yang dipersyaratkan untuk kontrak-kontrak yang dananya sebagian atau seluruhnya bersumber dari penerusan pinjaman/hibah luar negeri</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="13"></th>
            <td>Berita Acara pemeriksaan yang ditandatangani oleh pihak ketiga/rekanan serta unsur panitia pemeriksaan barang berikut lampiran daftar barang yang diperiksa</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="14"></th>
            <td>Surat angkutan atau konosemen apabila pengadaan barang dilaksanakan diluar wilayah kerja Surat pemberitahuan potongan denda keterlambatan pekerjaan dari PPTK apabila pekerjaan mengalami keterlambatan</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="15"></th>
            <td>Foto/Buku/Dokumentasi tingkat kemajuan/penyelesaian pekerjaan</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="16"></th>
            <td>Potongan jamsostek (potongan sesuai dengan ketentuan yang berlaku/surat pemberitahuan jamsostek)</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="17"></th>
            <td>Khusus untuk pekerjaan konsultan yang perhitungan harganya menggunakan biaya personil (billing rate), Berita Acara prestasi kemajuan pekerjaan dilampiri dengan bukti kehadiran dari tenaga konsultan sesual pentahapan waktu pekerjaan dan bukti penyewaan/pembelian alat penunjang serta bukti pengeluaran lainnya berdasarkan rincian dalam surat penawaran</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="18"></th>
            <td>Surat Ijin Usaha Perdagangan (SIUP) atau dokumen sejenisnya</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="19"></th>
            <td>Ijin Usaha Jasa Konstruksi (IUJK) atau dokumen sejenisnya</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="20"></th>
            <td>Surat Setoran Bukan Pajak (SSBP)</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="21"></th>
            <td>Daftar Pembayaran</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="22"></th>
            <td>Lampiran lain yang diperlukan</td>
        </tr>
        `;
    }
    else{
        mainContainer.innerHTML += `
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="23"></th>
            <td>Draft Surat Pernyataan untuk ditandatangani oleh Pengguna Anggaran/Kuasa Pengguna Anggaran yang menyatakan bahwa uang yang diminta tidak dipergunakan untuk keperluan selain uang persediaan saat pengejuan SP2D kepada Kuasa BUD</td>
        </tr>
        <tr>
            <th scope="row"><input type="checkbox" class="sub_chk" data-id="24"></th>
            <td>Lampiran lainnya</td>
        </tr>`;
    }

    $('#bodyCeklist input[type=checkbox]').removeAttr('checked');
    
    var ceklist = self.dataset.cek.split(',');
    ceklist.forEach(unit =>{
        $('#bodyCeklist input[data-id='+unit+']').prop('checked', true);
    });
}

$('.cetakCeklist').on('click', function(e) {
    
    allVals = [];
    $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
    });
    
    $("#idCeklist").attr("value", allVals);
    
});

const bendahara = @json($pejabat);
const rekanan = @json($rekanan);

const transaksi2bku = function(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    $modal = $('#transaksiToBKU');
    $form = $('#transaksiToBKUForm');
    $('#bukupembantu input[type=checkbox]').prop('checked', false);
    $form.find('input[name=idtransaksi]').val(data['id']);
    $modal.modal('show');
}

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
    }
    else {
        row.child( format(data)).show();
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
    var strhtml='<div class="form-group"><label>Jenis Pembukuan</label>'+
            '<select class="form-control" id="tipepembukuan" required>'+
            '<option value="" disabled selected>Jenis Pembukuan</option>'+
            '<option value="pindahbuku" >Pindah Buku</option>'+
            '<option value="tunai" >Tunai</option>'+
        '</select>'+
        '</div>'+
        '<label>Sumber Dana</label>'+
        '<input id="swal-input2" readonly class="form-control" value="BLUD" >';
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
                alert("Pilih Tipe Pembukuan Terlebih Dahulu");
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
async function cetak(type, id, tipepembukuan=null, nocek, tipe, listCek){
    var user = "{{Auth::user()->role}}";
    
    switch (type) {
        case 'spp':
            $('#cetakspp form').attr('action',"{{url('spp')}}/"+id);
            $('#cetaksppup').attr('formaction',"{{url('sppup')}}/"+id);
            $('#cetakceklist').attr('formaction',"{{url('ceklist')}}/"+id);
            $('#viewCeklist').attr("value", tipe).attr("data-cek", listCek);
            $("#formCeklist").attr("action", "{{url('/ceklist')}}/"+id);
            $('#cetakspp').modal('show');
            break;
        case 'spm':
            $('#cetakspm form').attr('action',"{{url('spm')}}/"+id);
            $('#cetaksptb').attr('formaction',"{{url('sptb')}}/"+id);
            $('#cetakspm').modal('show');
            break;
        case 'spd':
            $('#cetakspd form').attr('action',"{{url('spd')}}/"+id);
            $('#cetakspd').modal('show');
            break;
        case 'sp2d':
            if(tipepembukuan==='tunai' && user=='PKM' && !nocek){
                
                var strhtml='<div class="form-group"><label>No. Cek Bank</label>'+
                        '<input id="inputCek" name="inputCek" type="text" class="form-control" placeholder="Masukkan No. Cek Bank" ></div>'+
                        '<div class="form-group"><label>Tanggal Cek</label>'+
                        '<input id="inputTglCek" type="date" class="form-control" placeholder="Masukkan Tanggal" ></div>';
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
                    confirmButtonText: 'Cetak',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        $('#update').find('input[name=id]').val(id);
                        var valCek = document.getElementById('inputCek').value;
                        var valTgl = document.getElementById('inputTglCek').value;
                        if(valCek==='' || valTgl==='') {
                            alert("Isi No. Cek dan Tanggal Terlebih Dahulu");
                            return false;
                        }
                        $('#update').find('input[name=inputCek]').val(valCek);
                        $('#update').find('input[name=inputTglCek]').val(valTgl);
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        // $('#update').attr('action',"{{url('sp2d')}}/"+id).submit();
                        $('#update').submit();
                        window.location.reload();
                    }
                })
            }else{
                $('#cetaksp2d form').attr('action',"{{url('sp2d')}}/"+id).submit();
            }
            break;
    }
}

function edit(self){
    var $modal=$('#sunting');
    var tr = $(self).closest('tr');
    var data = oTable.fnGetData(tr);
    
    $modal.find('input[name=id]').val(data['id']);
    $modal.find('select[name=tipe]').val(data['tipe_raw']).change();
    $modal.find('input[name=tanggalref]').val(moment(data['tanggal_raw'], 'YYYY-MM-DD').format('L'));
    $modal.find('select[name=idsubkegiatan]').val(data['idsubkegiatan']).change();
    $modal.find('select[name=dibayarkan]').val(data['flagkepada']).change();
    $modal.find('select[name=idrekanan]').val(data['idkepada']).change();
    $modal.find('textarea[name=keterangan]').val(data['keterangan']);
    $modal.find('input[name=rekening]').val(data['rekening']);
}

function ubahRek(idtransaksi){
    $('#daftarrekening').find('input[name=id]').val(idtransaksi);
    var str=''
    for(var rek of oData[idtransaksi]['rekening']){
        str+=`<tr>
            <td>${rek[1]} - ${rek[2]}<input type="hidden" name="rekening[]" value="${rek[0]}" required></td>
            <td>${rek[3]}<input type="hidden" name="jumlah[]" value="${rek[3]}" required></td>
            <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
        </tr>`;
    }
    $('#rekeningtable tbody').html(str);
    $('#ubahRek').modal({backdrop: 'static', keyboard: false});
    $('#ubahRek').modal('show');
}

function ubahPajak(idtransaksi){
    $('#daftarpajak').find('input[name=id]').val(idtransaksi);
    var str=''
    for(var pajak of oData[idtransaksi]['pajak']){
        var str=`<tr>
            <td>${pajak[2]}<input type="hidden" name="pajak[]" value="${pajak[0]}" required></td>
            <td>${pajak[4]}<input type="hidden" name="kodebilling[]" value="${pajak[4]}" required></td>
            <td>${pajak[5]}<input type="hidden" name="tanggalkadaluarsa[]" value="${pajak[5]}" required></td>
            <td>${pajak[3]}<input type="hidden" name="nominalpajak[]" value="${pajak[3]}" required></td>
            <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
        </tr>`;
    }
    $('#pajaktable tbody').html(str);
    $('#ubahPajak').modal({backdrop: 'static', keyboard: false});
    $('#ubahPajak').modal('show');
}

function ubahPotongan(idtransaksi){
    $('#daftarpotongan').find('input[name=id]').val(idtransaksi);
    var str=''
    for(var potongan of oData[idtransaksi]['potongan']){
        var str=`<tr>
            <td>${potongan[0]}<input value="${potongan[0]}" type="hidden" name="kodepotongan[]"></input></td>
            <td>${potongan[1]}<input value="${potongan[1]}" type="hidden" name="potongan[]"></input></td>
            <td>${potongan[2]}<input value="${potongan[3]}" type="hidden" name="nominalpotongan[]"></input></td>
            <td><button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button></td>
        </tr>`;
    }
    $('#potongantable tbody').html(str);
    $('#ubahPotongan').modal({backdrop: 'static', keyboard: false});
    $('#ubahPotongan').modal('show');
}

function format(data){
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
    else if(data['kodetransaksi'] !== null){ //jika merupakan transaksi spp tarikan dari e-spj, berikan tombol edit daftar espjnya
        var tombolubah='<button class="btn btn-sm btn-primary float-right" onclick="edit_pilihan_espj_ls('+data.id+')" title="Tambah Rekening"><i class="fas fa-plus fa-sm"></i> Tambah</button>';
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

function infoSaldo(self, target){
    let option = $(self)[0].selectedOptions[0];
    if(option.value !==''){
        var val=$(option).data('saldo');
        $(self).closest("form").find('input[name=saldo]').val(val);
        $(target).text("saldo : "+my.formatRupiah(parseFloat(val)));
    }else{
        $(target).text("");
    }
}

//START of FORM Pilih SPP
var sppTable;
var callbackPilihSpp;
var sign=-99;
function openPilihSPP(urlparams, sign_, callback, FORCE_REFRESH=false, onComplete=function(settings, json){return ''} ){
    if(sign===sign_ && FORCE_REFRESH==false) return;
    if ($.fn.dataTable.isDataTable('#spptable') ) {
        $('#spptable').DataTable().clear();
        $('#spptable').DataTable().destroy();
        $('#spptable').empty();
    }
    sign=sign_;
    callbackPilihSpp=callback;

    if(sign==3 || sign==4){   // e-SPJ LS ditarik menjadi SPP LS
        $('#pilihSppLabel').text('Pilih e-SPJ');
        sppTable = $("#spptable").dataTable({
            processing: true,
            // serverSide: true,
            order: [[ 1, "desc" ]],
            select: {
                style:    'multi',
                selector: 'td:first-child input'
            },
            ajax: {type: "POST", url: '{{route("bku.getspp")}}'+urlparams, data:{'_token':@json(csrf_token())}},
            columns: [
                { data:'DT_RowIndex', orderable: false, searchable: false,  className: 'select-checkbox', render: function(){return '<input class="scale-1-5" type="checkbox" >';}} ,
                { data:'kodetransaksi', title:'ID Transaksi', name:'kodetransaksi',render: function(e,d,data){
                    return '<button onclick="callbackPilihSpp(\''+data['kodetransaksi']+'\','+data['id']+')" class="btn btn-sm btn-light text-nowrap border-1-gray-1 rounded-pill" ><i class="o-f-edelivery" ></i> '+data['kodetransaksi']+'</button>';
                }},
                { data:'tanggalref', title:'Tanggal', name:'tanggalref', render: function(e,d,row){return moment(row['tanggalref']).format('L');}},
                { data:'subkegiatan.kode', orderable: false, title:'Kode Subkegiatan', name:'subkegiatan.kode'},
                { data:'keterangan', orderable: false, title:'Uraian', name:'keterangan'},
            ],
            initComplete: onComplete,
        });
    }
    else if(sign==5){   // LPJ ditarik menjadi SPP GU
        $('#pilihSppLabel').text('Pilih LPJ-UP');
        sppTable = $("#spptable").dataTable({
            processing: true,
            // serverSide: true,
            order: [[ 1, "asc" ]],
            select: {
                style:    'multi',
                selector: 'td:first-child input'
            },
            ajax: {type: "POST", url: '{{route("lpj.getlpj")}}'+urlparams, data:{'_token':@json(csrf_token())}},
            columns: [
                { data:'DT_RowIndex', orderable: false, searchable: false,  className: 'select-checkbox', render: function(){return '<input class="scale-1-5" type="checkbox" >';}} ,
                { data:'id', title:'ID-LPJ' },
                { data:'nomor', title:'Nomor' },
                { data:'tanggal', title:'Tanggal', render: function(e,d,row){return moment(row['tanggalref']).format('L');}},
                { data:'total', className:'text-right', title:'Nominal', orderable: false, render: function(e,d,row){return my.formatRupiah(Math.trunc(row['total'])); } },
            ],
            initComplete: onComplete,
        });
    }
}

function pilih_espj_ls(){
    $form = $('#tarik_eSPJ_LS form');
    $form.find('input[name=currentIdTransaksi]').val('');
    $form.find('input[name=idtransaksi]').val('');
    $form.find('input[name=kodetransaksi]').val('');
    openPilihSPP('?upls=LS&isspj=1&nomor=NULL&parent=NULL',3, function(kodetransaksi,id){
        $form = $('#tarik_eSPJ_LS form');
        $form.find('input[name=idtransaksi]').val(id);
        $form.find('input[name=kodetransaksi]').val(kodetransaksi);
        $('#pilihSpp').modal('hide');
    });
    $('#tarik_eSPJ_LS').modal('show');
}

//fungsi untuk milih espj apa aja yg dicentang dari tabel sppTable
function pilih_multi(){
    let indexes = sppTable.api().rows({ selected: true })[0];
    let dataSelected = sppTable.api().rows({ selected: true }).data();
    var infoCentang='', ids='';
    for (let i = 0; i < indexes.length; i++) {
        if('kodetransaksi' in dataSelected[i]){
            infoCentang+=','+dataSelected[i].kodetransaksi.toString();
        }else if('nomor' in dataSelected[i]){
            infoCentang+=','+dataSelected[i].nomor.toString();
        }else{
            infoCentang+=','+dataSelected[i].id.toString();
        }
        ids+=','+dataSelected[i].id.toString();
    }
    infoCentang=infoCentang.substr(1);
    ids=ids.substr(1);
    callbackPilihSpp(infoCentang, ids);
}

function submit_espj_ls(e){
    if(my.getFormData($(e.target)).idtransaksi===''){
        e.preventDefault();
        alert('belum memilih espj');
    }
}

function select_espj_terpilih(setting, json, idsObject){
    sppTable.api().rows().every (function (rowIdx, tableLoop, rowLoop) {
        if (this.data().id in idsObject) {
            $(this.node()).find('td:first-child input[type=checkbox]').prop('checked', true);
            this.select ();
        }
    });
}

function edit_pilihan_espj_ls(idtransaksi){
    let dataSelected = oData[idtransaksi]['children'];
    console.log(dataSelected);
    $form = $('#tarik_eSPJ_LS form');
    $form.find('input[name=currentIdTransaksi]').val(idtransaksi);

    var kodetransaksis='', ids='';
    let idsObject={};
    for (let i = 0; i < dataSelected.length; i++) {
        if(i!=0){
            kodetransaksis+=','+dataSelected[i].kodetransaksi.toString();
            ids+=','+dataSelected[i].id.toString();
        }else{
            kodetransaksis+=dataSelected[i].kodetransaksi.toString();
            ids+=dataSelected[i].id.toString();
        }
        idsObject[dataSelected[i].id] = dataSelected[i].id;
    }

    $form.find('input[name=idtransaksi]').val(ids);
    $form.find('input[name=kodetransaksi]').val(kodetransaksis);
    openPilihSPP('?upls=LS&isspj=1&nomor=NULL&parent='+idtransaksi,4, function(kodetransaksi,id){ 
        $form = $('#tarik_eSPJ_LS form');
        $form.find('input[name=idtransaksi]').val(id);
        $form.find('input[name=kodetransaksi]').val(kodetransaksi);
        $('#pilihSpp').modal('hide');
    }, true, 
        function(s,j){select_espj_terpilih(s,j,idsObject);});   //force refresh tabel true
    $('#tarik_eSPJ_LS').modal('show');
}
//END of FORM Pilih SPP

// FORM PILIH LPJ
function open_form_tarik_lpj(){
    $form = $('#tarik_LPJ form');
    // $form.find('input[name=currentIdTransaksi]').val('');
    // $form.find('input[name=idtransaksi]').val('');
    // $form.find('input[name=kodetransaksi]').val('');
    $form.find('input[name=tipe]').val('GU');
    openPilihSPP('?upls=UP&transaksiterikat=NULL',5, function(infoCentang, ids){
        $('#pilihSpp').modal('hide');
        $form.find('input[name=idlpj]').val(ids);
        $form.find('input[name=nomorlpj]').val(infoCentang);
    });
    $('#tarik_LPJ').modal('show');
}
function submit_form_tarik_lpj(e){
    if(my.getFormData($(e.target)).idlpj===''){
        e.preventDefault();
        alert('belum memilih lpj');
    }
}
// END of FORM Pilih LPJ

$(document).ready(function(){
    $('#tambah').find('select[name=jenis]').val('0').change().attr('readonly',true);

    @php
    $date=Carbon\Carbon::now();
    $curDate=$date->format('Y-m-d');
    $date->day=31;
    $date->month=12;
    $maxDate=$date->format('Y-m-d');
    $date->day=1;
    $date->month=1;
    $minDate=$date->format('Y-m-d');
    @endphp
    const curDate='{{$curDate}}';
    const maxDate='{{$maxDate}}';
    const minDate='{{$minDate}}';
    $('#datetimepicker, #datetimepicker2, #datetimepicker3').datetimepicker({
        locale: 'id',
        format: 'L',
        defaultDate: curDate,
        maxDate: maxDate,
        minDate: minDate,
    });

    $('#tanggalkadaluarsa').datetimepicker({
        locale: 'id',
        format: 'L',
        defaultDate: curDate,
        minDate: curDate,
    });

    function renderNomor(d,t,row){
        if(row['isspj']==1){
            return row['nomor'] + '<button class="btn btn-sm btn-light text-nowrap border-1-gray-1 rounded-pill" disabled=""><i class="o-f-edelivery" ></i> '+
                row['kodetransaksi']+'</button>';
        }
        return row['nomor'];
    }

    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {type: "POST", url: '{{route("transaksi.data")}}', data:{'_token':@json(csrf_token())}},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' , title:'No.', name:'no'},
            { data:'tipe', orderable: false, width: 1 , title:'Tipe', name:'tipe'},
            { data:'tanggalref', title:'Tanggal', name:'tanggalref', render: function(e,d,row){return moment(row['tanggalref']).format('L');} },
            { data:'subkegiatan.nama',orderable: false, title:'Subkegiatan', name:'subkegiatan.nama'},
            { data:'nomor', title:'Nomor', name:'nomor', render:renderNomor},
            { data:'keterangan', orderable: false, width: '23rem', title:'Keperluan', name:'keterangan'},
            { data:'jumlah', title:'Jumlah', name:'jumlah'},
            @if(in_array($user->role,['PKM']))
            
            { data:'spp', orderable: false, searchable: false , title:'SPP', name:'spp'},
            { data:'spm', orderable: false, searchable: false , title:'SPM', name:'spm'},
            { data:'sp2d', orderable: false, searchable: false , title:'SP2D', name:'sp2d'},
            @elseif(in_array($user->role,['KEU']))
            { data:'sp2d', orderable: false, searchable: false , title:'SP2D', name:'sp2d'},
            @endif
            { data:'action', orderable: false, searchable: false, className: "text-right", width: '4rem', title:'Aksi', name:'aksi'},
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

        if(parseFloat(inputan['saldo']) - parseFloat(inputan['jumlah']) < 0){
            return alert('Saldo tidak mencukupi')
        }

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
    });
    
    $('#transaksiToBKUForm').submit(function(e){
        let checkedLen=$('#bukupembantu input[type=checkbox]:checked').length
        console.log(checkedLen);
        if(checkedLen===0){
            e.preventDefault();
            alert('Pilih satu atau lebih Buku Pembantu');
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
        oTable.api().columns().search( '' ); //reset semua filter
        values.forEach(function(s, i){
            var label=$(selectContainer[0].selectedOptions[i]).closest('optgroup').prop('label');            
            tagContainer.tagsinput('add', s);
            switch (label) {
                case "Status":
                    if(s==="ACCEPTED"){
                        oTable.api().column('status:name').search( 3 , true, false);
                    }else if(s==="SPM TERTOLAK"){
                        oTable.api().column('status:name').search( 4 , true, false);
                    }else if(s==="NEED ACC"){
                        oTable.api().column('status:name').search( 2 , true, false);
                    }
                    break;
                case "Tipe Transaksi":
                    oTable.api().column('tipe:name').search( s , true, false);
                    break;
                case "PKM":
                    oTable.api().column('unitkerja.nama:name').search( s , true, false);
                    break;
            }
        });
        oTable.api().draw();    // filter tabel
    });
    // END: Section of Filter 

});
</script>
@endsection