<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
        <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
        <title>PENELITIAN KELENGKAPAN DOKUMEN SPP</title>
        <style media="all" type="text/css">
            body{font-family:Verdana, Geneva, sans-serif;font-size:12px;padding:0px;margin:0px;}
            .tinggiHeader{height:136px;}
            .TebalBorder{ border-bottom:solid 2px;}
        </style>
        <link href="{{asset('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
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
                                <td class="headerFont fontCenter paddingfont" style="font-size:17px">PENELITIAN KELENGKAPAN DOKUMEN SPP</td>
                            </tr>
                            <tr>
                                <td class="headerFont fontCenter paddingfont" style="font-size:15px">TAHUN ANGGARAN : 2022</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                          <td class="paddingfont headerFont" style="font-size:15px">SPP-UP </td>
                                      </tr>
                                      <tr>
                                          <table width="100%">
                                          <tr>
                                              <td width="5%"><i class="far fa-square fa-fw"></i></td>
                                              <td>
                                                  Surat Pengantar SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td><i class="far fa-check-square fa-fw"></i></td>
                                              <td>
                                                  Ringkasan SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td><i class="far fa-check-square fa-fw"></i></td>
                                              <td>
                                                  Rincian SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td><i class="far fa-check-square fa-fw"></i></td>
                                              <td>
                                                  Salinan SPD
                                              </td>
                                          </tr>
                                          <tr>
                                              <td><i class="far fa-check-square fa-fw"></i></td>
                                              <td>
                                                  Draft Surat Pernyataan untuk ditandatangani oleh Pengguna Anggaran/Kuasa Pengguna Anggaran yang menyatakan bahwa uang yang diminta tidak dipergunakan untuk keperluan selain uang persediaan saat pengejuan SP2D kepada Kuasa BUD.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td width="5%"><i class="far fa-square fa-fw"></i></td>
                                              <td>
                                                  Lampiran Lainnya
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
                                          @php
                                          $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                          $mytime = Carbon\Carbon::make($transaksi->tanggal);
                                          @endphp
                                          <td class="headerFont fontCenter paddingfont" style="font-size:17px">PENELITIAN KELENGKAPAN DOKUMEN SPP</td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class="posisiAtas tinggiHeader">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td class="paddingfont paddingBawah" width="160">Nomor</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600"> {{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/UP/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Tanggal</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600"> {{Carbon\Carbon::make($transaksi->tanggal)->translatedFormat('d F Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Nama</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600"> {{$otorisator->nama}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">NIP</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600"> {{$otorisator->nip}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160"></td>
                                                    <td class="paddingfont paddingBawah" width="26"></td>
                                                    <td class="paddingfont paddingBawah" width="600"></td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Tanda Tangan</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600"></td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160"></td>
                                                    <td class="paddingfont paddingBawah" width="26"></td>
                                                    <td class="paddingfont paddingBawah" width="600"></td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Catatan</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">Pada saat SPP ini disetujui untuk diterbitkan e-SPM. PPK SKPD sudah memastikan bahwa e-SPM sebelumnya telah diterima oleh loket BUD.</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160"></td>
                                                    <td class="paddingfont paddingBawah" width="26"></td>
                                                    <td class="paddingfont paddingBawah" width="600"></td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Lembar Asli</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">Untuk Pengguna Anggaran / PPK-SKPD</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Salinan 1</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">Untuk Kuasa BUD</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Salinan 2</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">Untuk Bendahara Pengeluaran / PPTK</td>
                                                </tr>
                                                <tr>
                                                    <td class="paddingfont paddingBawah" width="160">Salinan 3</td>
                                                    <td class="paddingfont paddingBawah" width="26">:</td>
                                                    <td class="paddingfont paddingBawah" width="600">Untuk Arsip Bendahara Pengeluaran / PPTK</td>
                                                </tr>
                                            </tbody></table>
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