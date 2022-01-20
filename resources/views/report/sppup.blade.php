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
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:18px">SURAT PERMINTAAN PEMBAYARAN UANG PERSEDIAAN (SPP-UP)</td>
                            </tr>
                            <tr style="margin-bottom:30px;">
                                @php
                                $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                $mytime = Carbon\Carbon::make(2022);
                                @endphp
                                <td class="fontCenter paddingfont" style="font-size:15px">NOMOR :00007/1 02 0100/UP/I/2022</td>
                            </tr>
                            <tr>
                              <td class="fontCenter paddingfont" style="font-size:15px">Tahun Anggaran : 2022</td>
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
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Kode Rekening</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="30%">Uraian</td>
                                <td class="paddingfont fontBold" style="font-size:14px;" width="35%">Nilai Rupiah</td>
                            </tr>
                            <tr>
                                <td class="paddingfont" colspan=4>1.02.00.0.10.00/-9102 Aset</td>
                            </tr>
                            <tr>
                                <td class="paddingfont">1</td>
                                <td class="paddingfont">1.1.01.03.01.0001</td>
                                <td class="paddingfont">Kas di Bendahara Pengeluaran</td>
                                <td class="paddingfont">Rp. 550.000.000,00</td>
                            </tr>
                        </tbody>
                    </table>                
                    <table class="fontCenter" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td class="fontCenter fontBold" width="35%">&nbsp;</td>
                                <td width="30%">&nbsp;</td>
                                <td class="fontCenter" width="35%"></td>
                            </tr>
                            <tr>
                                <td class="fontCenter fontBold">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="fontCenter"></td>
                            </tr>
                            <tr>
                                <td class="fontCenter">Mengetahui/Menyetujui</td>
                                <td>&nbsp;</td>
                                <td class="fontCenter">Surabaya, 12 Januari 2022</td>
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
                                <td class="fontBold fontUnderline">Nanik Sukristina, SKM., M.Kes.</td>
                                <td>&nbsp;</td>
                                <td class="fontBold fontUnderline">Eny Asmorowati</td>
                            </tr>
                            <tr class="fontCenter">
                                <td>NIP. 19700117 199403 2 008</td>
                                <td>&nbsp;</td>
                                <td>NIP. 19711115 199402 2 001</td>
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