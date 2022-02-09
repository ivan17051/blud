<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERINTAH PENCAIRAN DANA BLUD (SP2D BLUD)</title>
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
    @php
    $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    $mytime = Carbon\Carbon::make($transaksi->tanggal);
    @endphp
    <table class="screen panjang">
        <tbody>
            <tr>
                <td class="jarak">
                    <table class="lebarKertasTegak" cellspacing="0" cellpadding="0" border="1">
                        <tbody>
                            <tr>
                              <td>
                                <table class="" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="fontCenter" width="100%"><img src="{{asset('/public/img/logo.gif')}}" width="39" height="50"></td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:16px">BLUD {{strtoupper($unitkerja->nama)}}</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                              <td>
                                <table width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:15px; vertical-align:bottom;">SURAT PERINTAH PENCAIRAN DANA</td>                                    
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:15px">BADAN LAYANAN UMUM DAERAH</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:15px">(SP2D BLUD)</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:15px">Nomor : NP00001/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                              <td>
                                                <table width="100%" border="0">
                                                  <tbody>
                                                    <tr>
                                                        <td class="paddingfont" width="30%">Nomor SPM</td>
                                                        <td class="paddingfont" width="3%">:</td>
                                                        <td class="paddingfont" width="67%"> {{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont"></td>
                                                        <td class="paddingfont"></td>
                                                        <td class="paddingfont"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Tanggal SPM</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> {{$transaksi->tanggal}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont"></td>
                                                        <td class="paddingfont"></td>
                                                        <td class="paddingfont"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Nama SKPD</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> BLUD {{$unitkerja->nama}}</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </td>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                              <td>
                                                <table width="100%" border="0">
                                                  <tbody>
                                                    <tr>
                                                        <td class="paddingfont" width="35%">Dari</td>
                                                        <td class="paddingfont" width="3%">:</td>
                                                        <td class="paddingfont" width="62%"> BLUD {{$unitkerja->nama}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">NPWP</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 00.137.508.8-609.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">No. Cek Bank</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> {{$transaksi->nocek}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Tanggal</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> @if($transaksi->tanggalcek){{Carbon\Carbon::make($transaksi->tanggalcek)->translatedFormat('d-m-Y')}} @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Tahun Anggaran</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 2022 </td>
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
                              <table style="margin:0; width:100%;">
                                <tbody>
                                  <tr>
                                      <td class="paddingfont" width="40%">Bank Pengirim</td>
                                      <td class="paddingfont" width="5%">:</td>
                                      <td class="paddingfont fontBold" width="55%">BPD JATIM</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Hendaklah mencairkan/memindahbukukan dari Bank Rekening Nomor</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">{{$bendahara->rekening}}</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Uang Sebesar</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">{{number_format($transaksi->jumlah,0,',','.')}}</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Terbilang</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">{{ucwords(Terbilang::make($transaksi->jumlah))}} Rupiah</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Cara Bayar</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">
                                        @if($transaksi->tipepembukuan=='pindahbuku') Pindah Buku
                                        @else {{ucwords($transaksi->tipepembukuan)}}
                                        @endif
                                      </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan=4>
                              <table style="margin:0; width:100%;">
                                <tbody>
                                  <tr>
                                      <td class="paddingfont" width="40%">Kepada</td>
                                      <td class="paddingfont" width="5%">:</td>
                                      <td class="paddingfont fontBold" width="55%">{{$bendahara->nama}} - Bendahara Pengeluaran {{$transaksi->unitkerja->nama}}</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">No. Rekening</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">{{$bendahara->rekening}}</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">NPWP</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">00.137.508.8-609.000</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Bank Penerima</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">BANK JATIM</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Keperluan Untuk</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold">{{$transaksi->keterangan}}</td>
                                  </tr>
                                  <tr>
                                      <td class="paddingfont">Pagu Anggaran</td>
                                      <td class="paddingfont">:</td>
                                      <td class="paddingfont fontBold"> {{number_format($transaksi->saldo,0,',','.')}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                    <table width="735px" cellspacing="0" cellpadding="0" border="1">
                        <tbody>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No.</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Kode Kegiatan</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Uraian</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Nilai</td>
                            </tr>
                            <tr>
                                <td class="paddingfont"></td>
                                <td class="paddingfont">1.02.00.0.10.00/-{{$transaksi->subkegiatan->kode}}</td>
                                <td class="paddingfont">{{$transaksi->subkegiatan->nama}}</td>
                                <td class="paddingfont"> {{number_format($transaksi->jumlah,0,',','.')}}</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontCenter" colspan=3>Jumlah</td>
                                <td class="paddingfont"> {{number_format($transaksi->jumlah,0,',','.')}}</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px;" colspan=4>Potongan-potongan :</td>
                            </tr>
                            <tr>
                              <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No.</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Uraian (No. Rekening)</td>
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
                                <td class="paddingfont">{{number_format($jumlahPotongan,0,',','.')}}</td>
                                <td class="paddingfont"></td>
                            </tr>
                            <tr>
                                <td class="paddingfont" style="font-size:14px;" colspan=4><b>Informasi :</b><i> (Tidak mengurangi jumlah pembayaran SPM)</i></td>
                            </tr>
                            <tr>
                              <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No.</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Uraian (No. Rekening)</td>
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
                            <td class="paddingfont fontBold" style="font-size:14px;" colspan=4><b>SP2D yang dibayarkan :</b></td>
                        </tr>
                        <tr>
                          <td class="paddingfont">Jumlah yang diminta</td>
                          <td class="paddingfont"> {{number_format($transaksi->jumlah-$jumlahPotongan,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah potongan</td>
                            <td class="paddingfont"> {{number_format($jumlahPajak,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah yang dibayarkan</td>
                            <td class="paddingfont"> {{number_format($transaksi->jumlah-$jumlahPotongan-$jumlahPajak,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont" colspan=2>Uang sejumlah : <i>({{ucwords(Terbilang::make($transaksi->jumlah-$jumlahPotongan))}})</i></td>
                        </tr>
                        <tr>
                          <td colspan=2>
                            <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr style="text-align:left;">
                                        <td class="paddingfont" colspan=4>&nbsp;</td>
                                    </tr>
                                    <tr style="text-align:left;">
                                        <td class="paddingfont" colspan=4><b>Lembar 1 :</b> Bank Yang Ditunjuk</td>
                                    </tr>
                                    <tr style="text-align:left;">
                                        <td class="paddingfont" colspan=4><b>Lembar 2 :</b> Kuasa Pengguna Anggaran</td>
                                    </tr>
                                    <tr style="text-align:left;">
                                        <td class="paddingfont" colspan=4><b>Lembar 3 :</b> Arsip</td>
                                    </tr>
                                    <tr style="text-align:left;">
                                        <td class="paddingfont" colspan=4><b>Lembar 4 :</b> Pihak Penerima</td>
                                    </tr>
                                    <tr>
                                        <td class="fontCenter fontBold" width="30%">&nbsp;</td>
                                        <td width="30%">&nbsp;</td>
                                        <td class="fontCenter">Surabaya, {{$mytime->translatedFormat('d F Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fontCenter fontBold">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="fontCenter fontBold">Bendahara Pengeluaran</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="fontCenter">
                                        <td class="fontBold fontUnderline">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="fontBold fontUnderline">{{$bendahara->nama}}</td>
                                    </tr>
                                    <tr class="fontCenter">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>NIP. {{$bendahara->nip}}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
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
      @if(Auth::user()->role=='PKM')
        window.print();
      @endif
    </script>
</body>

</html>