<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
        <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
        <title>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA (SPTB)</title>
        <style media="all" type="text/css">
            body{font-family:Verdana, Geneva, sans-serif;font-size:12px;padding:0px;margin:0px;}
            .tinggiHeader{height:136px;}
            .TebalBorder{ border-bottom:solid 2px;}
        </style>
    </head>
    <body>
        <table class="screen panjang">
            <tbody><tr>
                <td class="jarak">
                    <table class="lebarKertasTegak" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td class="fontCenter">
                                    <img src="{{asset('/public/img/logo.gif')}}" width="39" height="50">
                                </td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:21px">SURAT PERNYATAAN TANGGUNG JAWAB BELANJA (SPTB)</td>
                            </tr>
                            <tr>
                                @php
                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                $mytime = Carbon\Carbon::make($transaksi->tanggal);
                                @endphp
                                <td class="headerFont fontCenter paddingfont" style="font-size:12px">NOMOR :{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        <tr>
                            <td>
                                <table width="100%" height="168" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td class="posisiAtas borderBawah tinggiHeader TebalBorder">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td class="paddingfont paddingBawah" width="30">1. </td>
                                                    <td class="paddingfont paddingBawah" width="160">Nama SKPD</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">{{$transaksi->unitkerja->nama}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="30">2. </td>
                                                    <td class="paddingfont paddingBawah" width="160">Kode SKPD</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">1 02 0100/{{$transaksi->unitkerja->kode}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="30">3. </td>
                                                    <td class="paddingfont paddingBawah" width="160">Tanggal / No. DPA</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">{{Carbon\Carbon::make($transaksi->tanggal)->translatedFormat('d M Y')}}/{{$transaksi->unitkerja->id}} 1.02.05.2.01</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="30">4. </td>
                                                    <td class="paddingfont paddingBawah" width="160">Nama Sub-Kegiatan</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">{{$transaksi->subkegiatan->nama}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="30">5. </td>
                                                    <td class="paddingfont paddingBawah" width="160">Kode Sub-Kegiatan</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">1.02.05.2.01.01/-{{$transaksi->subkegiatan->kode}}</td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="paddingfont fontJustify">Yang bertanda tangan di bawah ini Kuasa Pengguna Anggaran {{$transaksi->unitkerja->nama}} menyatakan bahwa : </td>
                                    </tr>
                                    <tr>
                                        <table width="100%">
                                        <tr>
                                            <td width="3%">1.</td>
                                            <td>
                                                Jumlah {{$transaksi->tipe}} tersebut di atas akan digunakan untuk keperluan guna membiayai kegiatan yang akan kami laksanakan sesuai DPA - SKPD.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                Jumlah {{$transaksi->tipe}} tersebut tidak akan digunakana untuk membiayai keperluan - keperluan yang menurut ketentuan yang berlaku harus dilakukan dengan Pembayaran Langsung (LS).
                                            </td>
                                        </tr>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="2">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Demikan Surat Pernyataan ini dibuat dengan sebenarnya.</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%">&nbsp;</td>
                                                        <td class="fontCenter" width="50%">
                                                            <table class="fontCenter"  width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                <tbody><tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="50%" height="10">Surabaya, {{$mytime->translatedFormat('d F Y')}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                                                                                                <tr>
                                                                    <td class="paddingfont fontCenter"><strong>Kuasa Pengguna Anggaran</strong></td>
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
                                                                    <td class="fontCenter fontBold fontUnderline">{{$otorisator->nama}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fontCenter">NIP. {{$otorisator->nip}}</td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>  
                                            </div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>