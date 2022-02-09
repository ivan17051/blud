<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERINTAH MEMBAYAR (SPM)</title>
    <style media="all" type="text/css">
        body{
            font-family:Verdana, Geneva, sans-serif;
            font-size:12px;
            padding:0px;
            margin:0px;
        } 
        .TebalBorder{ 
            border-bottom:solid 2px;
        } 
        p{
            text-indent:40px;
        }
    </style>
</head>

<body>
    <table class="screen panjang">
        <tbody>
            <tr>
                <td class="jarak">
                    <table class="lebarKertasTegak" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td class="fontCenter"><img src="{{asset('/public/img/logo.gif')}}" width="39" height="50"></td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:18px">SURAT PERINTAH MEMBAYAR (SPM)</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">
                                @if($transaksi->tipe == 'UP')
                                Uang Persediaan (UP)</td>
                                @elseif($transaksi->tipe == 'LS')
                                Langsung (LS)</td>
                                @elseif($transaksi->tipe == 'TU')
                                Tambah Uang (TU)</td>
                                @endif
                            </tr>
                            
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="0" border="1">
                                        <tbody>
                                            <tr>
                                                @php
                                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                                $mytime = Carbon\Carbon::make($transaksi->tanggal);
                                                @endphp
                                              <td class="paddingfont fontBold" style="font-size:13px;" width="50%">Tahun Anggaran : {{$mytime->format('Y')}}</td>
                                              <td class="paddingfont fontBold" style="font-size:13px" width="50%">No. SPM :{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                                            </tr>
                                            <tr>
                                              <td colspan=2>
                                                <table width="100%" border="0">
                                                  <tbody>
                                                    <tr>
                                                      <td class="paddingfont fontBold" style="font-size:15px;" colspan=3>KUASA BENDAHARA UMUM DAERAH PEMERINTAH KOTA SURABAYA</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont" width="30%"></td>
                                                        <td class="paddingfont" width="3%"></td>
                                                        <td class="paddingfont" width="67%"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont" colspan=3>Supaya menerbitkan SP2D Kepada :</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">SKPD</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 1 02 0100/{{$transaksi->unitkerja->kode}} - {{$transaksi->unitkerja->nama}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Bendahara/Pihak Lain</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> {{$pihaklain->nama}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">No. Rekening Bank</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> {{$pihaklain->rekening}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Nama Bank</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 
                                                            @if($pihaklain->nip) BANK JATIM </td>
                                                            @else {{$pihaklain->namabank}} </td>
                                                            @endif
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">NPWP</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 
                                                            @if($pihaklain->nip) 00.137.508.8-609.000 </td>
                                                            @else {{$pihaklain->npwp}}</td>
                                                            @endif
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Dasar Pembayaran</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> SPD Nomor: 00009 Tanggal: 03 Januari 2022 </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="735px" height="168" cellspacing="0" cellpadding="0" border="1">
                        <tbody>
                          <tr>
                              <td colspan=4>
                                <table style="margin:0;">
                                  <tbody>
                                    <tr>
                                      <td class="paddingfont" colspan=3>Untuk Keperluan :</td>
                                    </tr>
                                    <tr>
                                      <td class="paddingfont" style="font-size:13px;" colspan=3> {{$transaksi->keterangan}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px;" colspan=3>Pembebasan pada Kegiatan :</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="25%">Kode Kegiatan</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="40%">Uraian</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Nilai</td>
                            </tr>
                            <tr>
                                <td class="paddingfont">1.02.00.0.10.00/-{{$transaksi->subkegiatan->kode}}</td>
                                <td class="paddingfont">{{$transaksi->subkegiatan->nama}}</td>
                                <td class="paddingfont">Rp. {{number_format($transaksi->jumlah,0,',','.')}}</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontCenter" colspan=2>Jumlah</td>
                                <td class="paddingfont">Rp. {{number_format($transaksi->jumlah,0,',','.')}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="735px" cellspacing="0" cellpadding="0" border="1">
                        <tbody>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px;" colspan=4>Potongan-potongan :</td>
                            </tr>
                            <tr>
                              <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No.</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Uraian<br>(No. Rekening)</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Jumlah</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Keterangan</td>
                            </tr>
                            @php
                            $jumlahPotongan=0;
                            $jumlahPajak=0;
                            @endphp
                            @foreach($transaksi->potongan as $key => $unit)
                            <tr>
                                <td class="paddingfont">{{$key+1}}</td>
                                <td class="paddingfont">{{$unit[0]}}</td>
                                <td class="paddingfont">{{number_format($unit[2],0,',','.')}}</td>
                                <td class="paddingfont">{{$unit[1]}}</td>
                            </tr>
                            @php
                            $jumlahPotongan += $unit[2];
                            @endphp
                            @endforeach
                            <tr>
                                <td class="paddingfont fontCenter" colspan=2>Jumlah</td>
                                <td class="paddingfont">{{$jumlahPotongan}}</td>
                                <td class="paddingfont"></td>
                            </tr>
                            <tr>
                                <td class="paddingfont" style="font-size:14px;" colspan=4><b>Informasi :</b><i> (Tidak mengurangi jumlah pembayaran SPM)</i></td>
                            </tr>
                            <tr>
                              <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No.</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Uraian<br>(No. Rekening)</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Jumlah</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Kode Billing</td>
                            </tr>
                            @foreach($transaksi->pajak as $key => $unit)
                            <tr>
                                <td class="paddingfont">{{$key+1}}</td>
                                <td class="paddingfont">{{$unit[2]}}</td>
                                <td class="paddingfont">{{number_format($unit[3],0,',','.')}}</td>
                                <td class="paddingfont">{{$unit[4]}}</td>
                            </tr>
                            @php
                            $jumlahPajak += $unit[3];
                            @endphp
                            @endforeach
                            <tr>
                                <td class="paddingfont fontCenter" colspan=2>Jumlah</td>
                                <td class="paddingfont">{{number_format($jumlahPajak,0,',','.')}}</td>
                                <td class="paddingfont"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="735px" height="168" cellspacing="0" cellpadding="0" border="1">
                      <tbody>
                        <tr>
                            <td class="paddingfont" style="font-size:14px;" colspan=4><b>SPM yang dibayarkan :</b></td>
                        </tr>
                        <tr>
                          <td class="paddingfont">Jumlah yang diminta</td>
                          <td class="paddingfont">{{number_format($transaksi->jumlah-$jumlahPotongan,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah potongan</td>
                            <td class="paddingfont">{{number_format($jumlahPajak,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah yang dibayarkan</td>
                            <td class="paddingfont">{{number_format($transaksi->jumlah-$jumlahPotongan-$jumlahPajak,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont" colspan=2>Uang sejumlah : <i>({{ucwords(Terbilang::make($transaksi->jumlah-$jumlahPotongan))}})</i></td>
                        </tr>
                        <tr>
                          <td width="60%">
                              <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                  <tbody>
                                      <tr>
                                          <td class="paddingfont fontBold">Jumlah SPP yang diminta : Rp. {{number_format($transaksi->jumlah-$jumlahPotongan,0,',','.')}}</td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont"><i>({{ucwords(Terbilang::make($transaksi->jumlah-$jumlahPotongan))}} Rupiah)</i></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont fontBold">Nomor dan Tanggal SPP :</td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont">{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont">{{$mytime->translatedFormat('d-m-Y')}}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                          <td>
                              <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                                  <tbody>
                                      <tr>
                                          <td class="fontCenter fontBold">&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td class="fontCenter">Surabaya, {{$mytime->translatedFormat('d F Y')}}</td>
                                      </tr>
                                      <tr>
                                          <td class="fontCenter fontBold">Kuasa Pengguna Anggaran</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr class="fontCenter">
                                          <td class="fontBold fontUnderline">{{$otorisator->nama}}</td>
                                      </tr>
                                      <tr class="fontCenter">
                                          <td>NIP. {{$otorisator->nip}}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </td>
            </tr>
            
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>