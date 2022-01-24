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
                                <td class="headerFont fontCenter paddingfont" style="font-size:16px">Uang Persediaan (UP)</td>
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
                                              <td class="paddingfont fontBold" style="font-size:13px" width="50%">No. SPM :{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/UP/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
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
                                                        <td class="paddingfont"> {{$bendahara->nama}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">No. Rekening Bank</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> {{$bendahara->rekening}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">Nama Bank</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> BANK JATIM </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="paddingfont">NPWP</td>
                                                        <td class="paddingfont">:</td>
                                                        <td class="paddingfont"> 00.137.508.8-609.000 </td>
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
                                <table>
                                  <tbody>
                                    <tr>
                                      <td class="paddingfont" colspan=3>Untuk Keperluan :</td>
                                    </tr>
                                    <tr>
                                      <td class="paddingfont" style="font-size:13px;" colspan=3> Pengisian Uang Persediaan di Bendahara Pengeluaran Dinas Kesehatan Tahun Anggaran 2022 sesuai SK Walikota Nomor 188.45/8/436.1.2/2022 Tanggal: 03 Januari 2022 Tentang Besaran Uang Persediaan Tahun Anggaran 2022</td>
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
                            <tr>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontCenter" colspan=2>Jumlah</td>
                                <td class="paddingfont">0,00</td>
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
                            <tr>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                                <td class="paddingfont"></td>
                            </tr>
                            <tr>
                                <td class="paddingfont fontCenter" colspan=2>Jumlah</td>
                                <td class="paddingfont">0,00</td>
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
                          <td class="paddingfont">Rp. {{number_format($transaksi->jumlah,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah potongan</td>
                            <td class="paddingfont">0,00</td>
                        </tr>
                        <tr>
                            <td class="paddingfont">Jumlah yang dibayarkan</td>
                            <td class="paddingfont">Rp. {{number_format($transaksi->jumlah,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <td class="paddingfont" colspan=2>Uang sejumlah : <i>({{ucwords(Terbilang::make(550000000))}})</i></td>
                        </tr>
                        <tr>
                          <td width="60%">
                              <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                  <tbody>
                                      <tr>
                                          <td class="paddingfont fontBold">Jumlah SPP yang diminta : Rp. 500.000.000</td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont"><i>({{ucwords(Terbilang::make(500000000))}} Rupiah)</i></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont fontBold">Nomor dan Tanggal SPP :</td>
                                      </tr>
                                      <tr>
                                          <td class="paddingfont">{{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/UP/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
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
                                          <td class="fontCenter fontBold">Pengguna Anggaran</td>
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