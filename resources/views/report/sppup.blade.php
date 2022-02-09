<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERMINTAAN PEMBAYARAN UANG PERSEDIAAN (SPP-UP)</title>
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
                                <td class="headerFont fontCenter paddingfont" style="font-size:15px">PEMERINTAH KOTA SURABAYA</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">SURAT PERMINTAAN PEMBAYARAN 
                                @if($transaksi->tipe == 'UP')
                                UANG PERSEDIAAN (SPP-UP)</td>
                                @elseif($transaksi->tipe == 'LS')
                                LANGSUNG (SPP-LS) BARANG DAN JASA</td>
                                @elseif($transaksi->tipe == 'TU')
                                UANG TAMBAH UANG (SPP-TU)</td>
                                @endif
                            </tr>
                            <tr style="margin-bottom:30px;">
                                @php
                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                $mytime = Carbon\Carbon::make($transaksi->tanggal);
                                @endphp
                                <td class="fontCenter paddingfont" style="font-size:15px">NOMOR :{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                            </tr>
                            <tr>
                              <td class="fontCenter paddingfont" style="font-size:15px">Tahun Anggaran : {{$mytime->format('Y')}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" height="50" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td class="paddingfont fontBold fontCenter" style="font-size:15px;" colspan=3>RINCIAN RENCANA PENGGUNAAN</td>
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
                                <td class="paddingfont fontBold" style="font-size:14px;" width="5%">No</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="25%">Kode Rekening</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="40%">Uraian</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Nilai Rupiah</td>
                            </tr>
                            <tr>
                                <td class="paddingfont" colspan=4>1.02.00.0.10.00/{{$transaksi->subkegiatan->kode}} {{$transaksi->subkegiatan->nama}}</td>
                            </tr>
                            @php
                            $jumlah=0;
                            @endphp
                            @foreach($transaksi->rekening as $key => $unit)
                            <tr>
                                <td class="paddingfont">{{$key+1}}</td>
                                <td class="paddingfont">{{$unit[1]}}</td>
                                <td class="paddingfont">{{$unit[2]}}</td>
                                <td class="paddingfont">Rp. {{number_format($unit[3],0,',','.')}}</td>
                            </tr>
                            @php
                            $jumlah += $unit[3];
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr style="float:right;">
                            <td class="fontBold" width="35%" style="font-size:14px;">Total Rp. {{number_format($jumlah,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td>Terbilang : {{ucwords(Terbilang::make($jumlah))}} Rupiah</td>
                        </tr>
                    </table>
                    <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="fontCenter fontBold">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="fontCenter"></td>
                            </tr>
                            <tr>
                                <td class="fontCenter">Mengetahui/Menyetujui</td>
                                <td>&nbsp;</td>
                                <td class="fontCenter">Surabaya, {{$mytime->translatedFormat('d F Y')}}</td>
                            </tr>
                            <tr>
                                <td class="fontCenter fontBold">Kuasa Pengguna Anggaran</td>
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
                                <td class="fontBold fontUnderline">{{$otorisator->nama}}</td>
                                <td>&nbsp;</td>
                                <td class="fontBold fontUnderline">{{$bendahara->nama}}</td>
                            </tr>
                            <tr class="fontCenter">
                                <td>NIP. {{$otorisator->nip}}</td>
                                <td>&nbsp;</td>
                                <td>NIP. {{$bendahara->nip}}</td>
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