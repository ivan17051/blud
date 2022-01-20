<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERMINTAAN PEMBAYARAN LANGSUNG BARANG DAN JASA</title>
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
                                <td class="headerFont fontCenter paddingfont" style="font-size:18px">SURAT PERMINTAAN PEMBAYARAN LANGSUNG BARANG DAN JASA</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont borderBawah TebalBorder" style="font-size:16px">(SPP-LANGSUNG BARANG DAN JASA)</td>
                            </tr>
                            <tr>
                                @php
                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                $mytime = Carbon\Carbon::make($transaksi->riwayat[0][0]);
                                @endphp
                                <td class="fontCenter paddingfont">NOMOR :00007/{{$transaksi->unitkerja->id}}/{{$transaksi->tipe}}.BLUD/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}} TAHUN : {{$mytime->format('Y')}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" height="168" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont fontBold fontCenter" style="font-size:16px;">SURAT PENGANTAR</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">Kepada Yth.</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">Pengguna Anggaran</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont"> {{$transaksi->unitkerja->nama}} </td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont">di Tempat</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="paddingfont fontJustify">
                                                    <p>Dengan memperhatikan Peraturan Walikota Nomor 71 Tahun 2020 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2022 Kota Surabaya , bersama ini kami mengajukan Surat permintaan pembayaran langsung barang dan jasa sebagai berikut :
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="paddingfont" width="3%">a. </td>
                                                                <td class="paddingfont" width="28%"> Urusan Pemerintahan</td>
                                                                <td class="paddingfont" width="2%">:</td>
                                                                <td class="paddingfont" width="67%"> Urusan Pemerintahan Bidang Kesehatan </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">b.</td>
                                                                <td class="paddingfont">SKPD</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont">{{$transaksi->unitkerja->id}} {{$transaksi->unitkerja->nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">c. </td>
                                                                <td class="paddingfont"> Tahun Anggaran</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont">2022</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">d. </td>
                                                                <td class="paddingfont"> Dasar Pengeluaran, SPD Nomor</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont"> 00002 Tgl. 04/01/2021 s/d 00147 Tgl. 27/01/2021 </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">e. </td>
                                                                <td class="paddingfont"> Jumlah Sisa Dana SPD</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont"> Rp. 2.010.834.250,00 </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td class="paddingfont">(Dua Milyar Sepuluh Juta Delapan Ratus Tiga Puluh Empat Ribu Dua Ratus Lima Puluh Rupiah)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">f. </td>
                                                                <td class="paddingfont">Nama Bendahara Pengeluaran</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont"> Eny Asmorowati </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">g. </td>
                                                                <td class="paddingfont">Jumlah Pembayaran yang Diminta</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont"> Rp {{number_format($transaksi->jumlah, 2, ',', '.')}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td class="paddingfont">({{ucwords(Terbilang::make($transaksi->jumlah))}} Rupiah)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td class="paddingfont">{{$transaksi->keterangan}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="paddingfont">h. </td>
                                                                <td class="paddingfont">Nama dan Nomor Rekening Bank</td>
                                                                <td class="paddingfont">:</td>
                                                                <td class="paddingfont"> {{$transaksi->rekening->nama}} - Terlampir </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
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
                                                <td>
                                                    <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="fontCenter fontBold" width="38%">Mengetahui,</td>
                                                                <td width="26%">&nbsp;</td>
                                                                <td class="fontCenter" width="36%">Surabaya, {{$transaksi->riwayat[0][0]}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fontCenter fontBold">Pejabat Pelaksana Teknis Kegiatan</td>
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
                                                                <td class="fontBold fontUnderline">dr. Mira Novia</td>
                                                                <td>&nbsp;</td>
                                                                <td class="fontBold fontUnderline">Eny Asmorowati</td>
                                                            </tr>
                                                            <tr class="fontCenter">
                                                                <td>NIP. 19621117 199103 2 005</td>
                                                                <td>&nbsp;</td>
                                                                <td>NIP. 19711115 199402 2 001</td>
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
                </td>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>