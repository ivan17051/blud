<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>BUKU BANK</title>
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
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">BADAN LAYANAN UMUM DAERAH</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:18px">BUKU BANK</td>
                            </tr>
                            <tr style="margin-bottom:30px;">
                                <td class="fontCenter paddingfont" style="font-size:15px">Bulan: {{Carbon\Carbon::make($bulan)->translatedFormat('F Y')}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td class="paddingfont" style="font-size:14px;" colspan=3>SKPD: 1 02 00 0100/{{$pkm->kode}} - {{$pkm->nama}}</td>
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
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle;" rowspan=2 width="5%">Tanggal</td>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle;" rowspan=2>Keterangan</td>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle;" rowspan=2>Referensi</td>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle; text-align:center;" colspan=2>Mutasi</td>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle;" rowspan=2>Saldo</td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle; text-align:center;">Debit</td>
                                <td class="paddingfont fontBold" style="font-size:14px; vertical-align:middle; text-align:center;">Kredit</td>
                            </tr>
                            @php
                            $jumlah = $saldoAwal->nominal;
                            @endphp
                            <tr>
                              <td></td>
                              <td class="paddingfont" colspan="4">Saldo Awal</td>
                              <td class="paddingfont">{{number_format($saldoAwal->nominal,2,',','.')}} </td>
                            </tr>
                            @foreach($bukuBank as $unit)
                            <tr>
                                <td class="paddingfont">{{$unit->tanggal}}</td>
                                <td class="paddingfont">{{$unit->uraian}}</td>
                                <td class="paddingfont">{{$unit->noref}}</td>
                                <td class="paddingfont">
                                    @if($unit->jenis==1)
                                    {{number_format($unit->nominal,2)}}
                                    @php
                                    $jumlah += $unit->nominal;
                                    @endphp
                                    @else - 
                                    @endif</td>
                                <td class="paddingfont">
                                    @if($unit->jenis==0)
                                    {{number_format($unit->nominal,2)}}
                                    @php
                                    $jumlah -= $unit->nominal;
                                    @endphp
                                    @else - 
                                    @endif</td>
                                <td class="paddingfont">
                                    {{number_format($jumlah,2,',','.')}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                              <td></td>
                              <td class="paddingfont" colspan="4">Saldo Akhir</td>
                              <td class="paddingfont">{{number_format($jumlah,2,',','.')}}</td>
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