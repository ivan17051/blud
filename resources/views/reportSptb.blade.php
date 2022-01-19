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
                                <td class="headerFont fontCenter paddingfont" style="font-size:12px">NOMOR :00146/{{$transaksi->unitkerja->id}}/{{$transaksi->tipe}}.BLUD/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
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
                                                    <td class="paddingfont paddingBawah" width="600">{{$transaksi->unitkerja->id}}</td>
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
                                                    <td class="paddingfont paddingBawah" width="600">1.02.05.2.01.01/{{$transaksi->subkegiatan->kode}}</td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="paddingfont fontJustify">Yang bertanda tangan di bawah ini Kuasa Pengguna Anggaran {{$transaksi->unitkerja->nama}} menyatakan bahwa saya bertanggung jawab 
                                            penuh atas kebenaran formal dan material serta kebenaran perhitungan pemungutan / pemotongan pajak maupun segala akibat yang timbul dari pengeluaran 
                                            yang dibayar lunas oleh Bendahara Umum Daerah kepada yang berhak menerima dengan rincian sebagai berikut:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="borderBawah TebalBorder">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="paddingfont">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="1">
                                                <tbody>
                                                    <tr class="fontBold fontCenter">
                                                        <td class="paddingfont" width="5%">No.</td>
                                                        <td class="paddingfont" width="21%">Kode Sub-Rekening</td>
                                                        <td class="paddingfont" width="53%">Uraian</td>
                                                        <td class="paddingfont" width="21%">Jumlah (Rp)</td>
                                                    </tr>
                                                    @php
                                                    $jumlah=0;
                                                    @endphp
                                                    <tr>
                                                        <td class="paddingfont">1</td>
                                                        <td class="paddingfont">{{$transaksi->rekening->kode}}</td>
                                                        <td class="paddingfont">{{$transaksi->rekening->nama}}</td>
                                                        <td class="paddingfont fontKanan">{{number_format($transaksi->jumlah, 2, ',', '.')}}</td>
                                                    </tr>
                                                    @php
                                                    $jumlah += $transaksi->jumlah;
                                                    @endphp
                                                    <tr class="fontBold ">
                                                        <td colspan="3" class="paddingfont">Total</td>
                                                        <td class="paddingfont fontKanan">{{number_format($jumlah, 2, ',', '.')}}</td>
                                                    </tr>
                                                    <tr>
                                                        @php
                                                        $terbilang = Terbilang::make($jumlah);
                                                        @endphp
                                                        <td colspan="4" class="paddingBawah paddingfont fontBold">Terbilang : {{ucwords(Terbilang::make($jumlah))}} Rupiah</td>
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
                                        <td>
                                            <div>
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody><tr>
                                                        <td colspan="2" class="fontJustify">Asli bukti-bukti pengeluaran anggaran dan surat setoran pajak tersebut di atas disimpan pada
                                                            {{$transaksi->unitkerja->nama}} sesuai dengan ketentuan yang berlaku, untuk kelengkapan administrasi dan keperluan pemeriksaan aparat pengawasan fungsional (post audit).
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Demikan Surat Pernyataan ini dibuat dengan sebenarnya.</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%">&nbsp;</td>
                                                        <td class="fontCenter" width="50%">
                                                            <table class="fontCenter" style="background: url('https://epayment.surabaya.go.id:9090/sipk/2021/dependencies/ttd/1 02 0100/196511241992032009/2');background-repeat: no-repeat; background-position: center" width="100%" cellspacing="0" cellpadding="0" border="0">
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
                                                                    <td class="fontCenter fontBold fontUnderline">drg. Yohana Sussie Emissa</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fontCenter">NIP. 19651124 199203 2 009</td>
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