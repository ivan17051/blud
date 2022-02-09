<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERMINTAAN PEMBAYARAN (SPP)</title>
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
                                <td class="headerFont fontCenter paddingfont" style="font-size:18px">SURAT PERMINTAAN PEMBAYARAN (SPP)</td>
                            </tr>
                            <tr style="margin-bottom:30px;">
                                @php
                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                $mytime = Carbon\Carbon::make($transaksi->tanggal);
                                @endphp
                                <td class="fontCenter paddingfont" style="font-size:15px">NOMOR :{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" height="168" cellspacing="0" cellpadding="0" border="1">
                                        <tbody>
                                            <tr>
                                                @if($transaksi->tipe == 'UP')
                                                <td class="paddingfont fontBold fontCenter" style="font-size:15px;" colspan=3>UANG PERSEDIAAN</td>
                                                @elseif($transaksi->tipe == 'LS')
                                                <td class="paddingfont fontBold fontCenter" style="font-size:15px;" colspan=3>LANGSUNG BARANG DAN JASA</td>
                                                @elseif($transaksi->tipe == 'TU')
                                                <td class="paddingfont fontBold fontCenter" style="font-size:15px;" colspan=3>TAMBAH UANG</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td class="paddingfont fontBold fontCenter" style="font-size:15px;" colspan=3>SPP-{{$transaksi->tipe}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="paddingfont" width="30%"></td>
                                                <td class="paddingfont" width="3%"></td>
                                                <td class="paddingfont" width="67%"></td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">1. Nama SKPD</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> 
                                                    1 02 00 0100/{{$transaksi->unitkerja->kode}} - {{$transaksi->unitkerja->nama}} 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">2. Nama Kuasa Pengguna Anggaran</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> {{$otorisator->nama}}</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">3. Nama Bendahara Pengeluaran / Pihak Lain</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> {{$pihaklain->nama}}</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">4. NPWP Bendahara Pengeluaran / Pihak Lain</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> 
                                                    @if($pihaklain->nip) 00.137.508.8-609.000</td>
                                                    @else {{$pihaklain->npwp}}</td>
                                                    @endif
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">5. Nama Bank</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont">
                                                    @if($pihaklain->nip) BANK JATIM </td>
                                                    @else {{$pihaklain->namabank}} </td>
                                                    @endif
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">6. Nomor Rekening Bank</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> {{$pihaklain->rekening}}</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">7. Untuk Keperluan</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> {{$transaksi->keterangan}}</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">8. Dasar Pengeluaran</td>
                                                <td class="paddingfont">:</td>
                                                <td class="paddingfont"> SPD Nomor: 00009 Tanggal: 03 Januari 2022 </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="paddingfont">Sebesar: Rp. {{number_format($transaksi->saldo,0,',','.')}} <br>({{ucwords($terbilang)}} Rupiah)</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">&nbsp;</td>
                                                <td class="paddingfont">&nbsp;</td>
                                                <td class="paddingfont">&nbsp;</td>
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
                                <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" colspan=3>Uraian</td>
                            </tr>
                            <tr>
                                <td class="paddingfont">&nbsp;</td>
                                <td class="paddingfont" colspan=2>&nbsp;</td>
                                <td class="paddingfont">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold">I</td>
                                <td class="paddingfont fontBold" colspan=2>SPD</td>
                                <td class="paddingfont">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="paddingfont">&nbsp;</td>
                                <td class="paddingfont" width="30%">Tanggal: 03 Januari 2022</td>
                                <td class="paddingfont" width="30%">Nomor: 00009</td>
                                <td class="paddingfont" width="35%">Rp. {{number_format($transaksi->saldo,0,',','.')}}</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold">II</td>
                                <td class="paddingfont fontBold" colspan=2>SP2D Sebelumnya</td>
                                <td class="paddingfont">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="paddingfont">&nbsp;</td>
                                <td class="paddingfont">Tanggal: </td>
                                <td class="paddingfont">Nomor: </td>
                                <td class="paddingfont"></td>
                            </tr>
                            <tr>
                                <td class="paddingfont" colspan=4>
                                    Pada SPP ini ditetapkan lampiran-lampiran yang diperlukan sebagaimana tertera pada daftar kelengkapan
                                    dokumen SPP ini.
                                </td>
                            </tr>
                            <tr>
                                <td colspan=4>
                                    <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td class="fontCenter fontBold" width="30%">&nbsp;</td>
                                                <td width="30%">&nbsp;</td>
                                                <td class="fontCenter"></td>
                                            </tr>
                                            <tr>
                                                <td class="fontCenter fontBold">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="fontCenter"></td>
                                            </tr>
                                            <tr>
                                                <td class="fontCenter fontBold">&nbsp;</td>
                                                <td>&nbsp;</td>
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
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr style="text-align:left;">
                                                <td class="paddingfont" colspan=4><b>Lembar Asli:</b> Untuk Pengguna Anggaran</td>
                                            </tr>
                                            <tr style="text-align:left;">
                                                <td class="paddingfont" colspan=4><b>Salinan 1:</b> Untuk Kuasa BUD</td>
                                            </tr>
                                            <tr style="text-align:left;">
                                                <td class="paddingfont" colspan=4><b>Salinan 2:</b> Untuk Bendahara Pengeluaran</td>
                                            </tr>
                                            <tr style="text-align:left;">
                                                <td class="paddingfont" colspan=4><b>Salinan 3:</b> Untuk Arsip Bendahara Pengeluaran</td>
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