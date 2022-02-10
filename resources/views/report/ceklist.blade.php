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
                                          <td class="paddingfont headerFont" style="font-size:15px">SPP-{{$transaksi->tipe}} </td>
                                      </tr>
                                      <tr>
                                          <table width="100%">
                                          @if($transaksi->tipe=='LS')
                                          <tr>
                                              <td width="5%" class="paddingfont paddingBawah"> 
                                                  @if(in_array("0", $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif
                                                </td>
                                              <td class="paddingfont paddingBawah">
                                                  Surat Pengantar SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(1, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif
                                              </td>
                                              <td class="paddingfont paddingBawah">
                                                  Ringkasan SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(2, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Rincian SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(3, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Salinan SPD
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(4, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Salinan Surat Rekomendasi dari SKPD teknis terkait.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(5, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              SSP disertai faktur pajak (PPN dan PPh) yang telah ditandatangani wajib pajak dan wajib pungut.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(6, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Surat perjanjian kerjasama/kontrak antara pengguna anggaran/kuasa pengguna anggaran dengan pihak ketiga serta mencantumkan nomor rekening bank (dibuktikan dengan referensi bank yang diterbitkan pada Tahun Anggaran berkenaan, untuk kepentingan mengikuti pekerjaan di Pemerintah Kota Surabaya) pihak ketiga
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(7, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Berita Acara penyelesaian pekerjaan.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(8, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Berita Acara serah terima barang dan jasa.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(9, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Berita Acara Pembayaran.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(10, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Kwitansi bermaterai, nota/faktur yang ditandatangani pihak ketiga dan PPTK serta disetujui oleh pengguna anggaran/kuasa pengguna anggaran.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(11, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Surat jaminan bank atau yang dipersamakan yang dikeluarkan oleh bank atau lembaga keuangan non bank.
                                              </td>
                                        </tr>
                                        <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(12, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Dokumen lain yang dipersyaratkan untuk kontrak-kontrak yang dananya sebagian atau seluruhnya bersumber dari penerusan pinjaman/hibah luar negeri.
                                              </td>
                                        </tr>
                                        <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(13, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Berita Acara pemeriksaan yang ditandatangani oleh pihak ketiga/rekanan serta unsur panitia pemeriksaan barang berikut lampiran daftar barang yang diperiksa.
                                              </td>
                                        </tr>
                                        <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(14, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Surat angkutan atau konosemen apabila pengadaan barang dilaksanakan diluar wilayah kerja Surat pemberitahuan potongan denda keterlambatan pekerjaan dari PPTK apabila pekerjaan mengalami keterlambatan.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(15, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Foto/Buku/Dokumentasi tingkat kemajuan/penyelesaian pekerjaan.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(16, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Potongan jamsostek (potongan sesuai dengan ketentuan yang berlaku/surat pemberitahuan jamsostek).
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(17, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Khusus untuk pekerjaan konsultan yang perhitungan harganya menggunakan biaya personil (billing rate), Berita Acara prestasi kemajuan pekerjaan dilampiri dengan bukti kehadiran dari tenaga konsultan sesual pentahapan waktu pekerjaan dan bukti penyewaan/pembelian alat penunjang serta bukti pengeluaran lainnya berdasarkan rincian dalam surat penawaran.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(18, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Surat Ijin Usaha Perdagangan (SIUP) atau dokumen sejenisnya.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(19, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Ijin Usaha Jasa Konstruksi (IUJK) atau dokumen sejenisnya.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(20, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Surat Setoran Bukan Pajak (SSBP).
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(21, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Daftar Pembayaran.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(22, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                              Lampiran lain yang diperlukan
                                              </td>
                                          </tr>
                                            @elseif($transaksi->tipe=='UP' || $transaksi->tipe=='TU')
                                          <tr>
                                              <td width="5%" class="paddingfont paddingBawah">
                                                  @if(in_array("0", $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Surat Pengantar SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(1, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Ringkasan SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(2, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Rincian SPP
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(3, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Salinan SPD
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="paddingfont paddingBawah">
                                                  @if(in_array(23, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Draft Surat Pernyataan untuk ditandatangani oleh Pengguna Anggaran/Kuasa Pengguna Anggaran yang menyatakan bahwa uang yang diminta tidak dipergunakan untuk keperluan selain uang persediaan saat pengejuan SP2D kepada Kuasa BUD.
                                              </td>
                                          </tr>
                                          <tr>
                                              <td width="5%" class="paddingfont">
                                                  @if(in_array(24, $transaksi->ceklist))<i class="far fa-check-square fa-fw"></i>
                                                  @else <i class="far fa-square fa-fw"></i>
                                                  @endif</td>
                                              <td class="paddingfont paddingBawah">
                                                  Lampiran Lainnya
                                              </td>
                                          </tr>
                                          @endif
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
                                                    <td class="paddingfont paddingBawah" width="600"> {{$transaksi->nomor}}/1 02 0100/{{$transaksi->unitkerja->kode}}/{{$transaksi->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
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