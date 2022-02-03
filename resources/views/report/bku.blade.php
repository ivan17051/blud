<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT PERINTAH PENCAIRAN DANA BLUD (BKU BLUD)</title>
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
    @php
    $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    $mytime = Carbon\Carbon::make('2022-01-01');
    @endphp
    <table class="screen lebar">
        <tbody>
            <tr>
                <td class="jarak">
                    <table class="lebarKertasTidur" cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td>
                                <table class="" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td class="fontCenter" width="100%"><img src="{{asset('/public/img/logo.gif')}}" width="39" height="50"></td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:16px">{{strtoupper($unitkerja->nama)}}</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:14px">Tahun Anggaran: {{$mytime->format('Y')}}</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:13px; vertical-align:bottom;">BUKU KAS UMUM</td>                                    
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:13px">Periode: Januari</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <!-- //  START OF TABEL BKU  // -->
                                <table class="borderSemua" width="100%" >
                                  <thead>
                                    <tr>
                                      <th class="paddingfont" >ID BKU</th>
                                      <th class="paddingfont" >No.</th>
                                      <th class="paddingfont" >Tanggal</th>
                                      <th class="paddingfont" >No. Bukti</th>
                                      <th class="paddingfont" >Ket.</th>
                                      <th class="paddingfont" >Uraian</th>
                                      <th class="paddingfont" >Penerimaan</th>
                                      <th class="paddingfont" >Pengeluaran</th>
                                      <th class="paddingfont" >Saldo</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $saldo=0; @endphp
                                    @foreach($bku as $i=>$b)
                                      @php 
                                        $saldo+= (($b->jenis==1) ? 1 : -1)*$b->nominal; 
                  
                                        if($b->nominal < 0){
                                          $nominal='('.number_format($b->nominal*-1,0,',','.').')';
                                        }else{
                                          $nominal=number_format($b->nominal,0,',','.');
                                        }
                                      @endphp
                                    <tr>
                                      <td class="paddingfont fontCenter" >{{$b->nomor}}</td>
                                      <td class="paddingfont fontCenter" >{{$i+1}}</td>
                                      <td class="paddingfont fontCenter" >{{$b->tanggal}}</td>
                                      @if(isset($b->idtransaksi))
                                      <td class="paddingfont fontCenter" >{{$b->transaksi->nomor}}/1 02 0100/{{$unitkerja->kode}}/{{$b->tipe}}/F/{{$bulan[ltrim($mytime->format('m'),'0')]}}/{{$mytime->format('Y')}}</td>
                                      @else
                                      <td class="paddingfont fontCenter" ></td>
                                      @endif
                                      <td class="paddingfont fontCenter" >{{$b->tipe}}</td>
                                      <td class="paddingfont ">{{$b->uraian}}</td>
                                      <td class="paddingfont fontKanan">{{$b->jenis==1 ? $nominal : ''}}</td>
                                      <td class="paddingfont fontKanan">{{$b->jenis==0 ? $nominal : ''}}</td>
                                      <td class="paddingfont fontKanan">{{number_format($saldo,0,',','.')}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                <!-- //  END OF TABEL BKU  // -->
                              </td>
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