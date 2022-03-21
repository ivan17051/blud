## Transaksi Controller

:date: posted\: 09-02-2022

:memo: last updated\: 14-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [penyebut](#penyebut)
- [terbilang](#terbilang)
- [index](#index)
- [data](#data)
- [storeUpdateTransaksi](#storeupdatetransaksi)
- [deleteTransaksi](#deletetransaksi)
- [tolakTransaksi](#tolaktransaksi)
- [batalkanPengajuanSP2D](#batalkanpengajuansp2d)
- [accTransaksi](#acctransaksi)
- [inputCek](#inputcek)
- [sptb](#sptb)
- [ceklist](#ceklist)
- [spp](#spp)
- [sppup](#sppup)
- [spm](#spm)
- [sp2d](#sp2d)
- [espjToTransaksi](#espjtotransaksi)
- [lpjToTransaksi](#lpjtotransaksi)
- [getSp2dInfo](#getsp2dinfo)

## penyebut 
Mengkonversi nominal menjadi dalam bentuk tertulis.

#### Return Value
Hasil konversi nominal menjadi dalam bentuk tertulis.

:cyclone: [to top](#contents)

## terbilang 
Mendeteksi jika nominal adalah bilangan lebih kecil dari nol atau tidak.

#### Return Value
Hasil konversi nominal melalui fungsi [penyebut](#penyebut) beserta dengan hasil deteksi bilangan minus atau tidak.

:cyclone: [to top](#contents)


## index 
Menampilkan halaman SPP-SPM kosong.

#### Return Value
[Transaksi View](https://github.com/ivan17051/blud/blob/master/resources/views/transaksi.blade.php)<br>
with:<br>
&emsp;&emsp;[SubKegiatan](https://github.com/ivan17051/blud/blob/master/app/SubKegiatan.php): Collections<br>
&emsp;&emsp;[Rekening](https://github.com/ivan17051/blud/blob/master/app/Rekening.php): Collections<br>
&emsp;&emsp;[User](https://github.com/ivan17051/blud/blob/master/app/User.php): Collections<br>
&emsp;&emsp;[Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php): Collections<br>
&emsp;&emsp;[Pajak](#https://github.com/ivan17051/blud/blob/master/app/Pajak.php): Collections

:cyclone: [to top](#contents)

## data
Menarik data SPP dari tabel **transaksi** dan menghasilkan queri _Datatable server side_.

#### Parameters
Request

#### Return Value
Datatables

:cyclone: [to top](#contents)

## storeUpdateTransaksi
Menyimpan data SPP baru atau data SPP yang diubah, serta menyimpan data e-SPJ baru atau data e-SPJ yang diubah ke tabel **transaksi**.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## deleteTransaksi
_Soft delete_ data SPP atau data e-SPJ dari tabel **transaksi** dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## tolakTransaksi
Menolak SPP yang diajukan sebagai SP2D dengan merubah properti **status** = 4.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## batalkanPengajuanSP2D
Membatalkan pengajuan SP2D dengan merubah properti **status** = 1.
#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## accTransaksi
Merubah status transaksi SPP menjadi salah satu dari tiga kondisi, berikut:

- Membuat SPM dari informasi SPP, **status**=1
- Mengajukan SPP sebagai SP2D, **status**=2
- Menerima SP2D yang diajukan oleh Puskesmas, **status**=3

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## inputCek
Menyimpan data nomor cek dan tanggal cek pada tabel transaksi

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## sptb
Menampilkan SPTB yang dapat diprint

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report SPTB View](https://github.com/ivan17051/blud/blob/master/resources/views/report/sptb.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>

:cyclone: [to top](#contents)

## ceklist
Menampilkan Ceklist yang dapat diprint

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report Ceklist View](https://github.com/ivan17051/blud/blob/master/resources/views/report/ceklist.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>

:cyclone: [to top](#contents)

## spp
Menampilkan SPP yang dapat diprint

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report SPP View](https://github.com/ivan17051/blud/blob/master/resources/views/report/spp.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bendahara: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Pihak Lain: ([Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php) or [Rekanan](https://github.com/ivan17051/blud/blob/master/app/Rekanan.php))<br>
&emsp;&emsp;Terbilang: [Terbilang](#terbilang)


:cyclone: [to top](#contents)

## sppup
Menampilkan Rincian Rencana Penggunaan yang dapat di-print

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report SPPUP View](https://github.com/ivan17051/blud/blob/master/resources/views/report/sppup.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bendahara: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>

:cyclone: [to top](#contents)

## spm
Menampilkan PDF SPM yang dapat di-_print_.

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report SPM View](https://github.com/ivan17051/blud/blob/master/resources/views/report/spm.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bendahara: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Pihak Lain: ([Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php) or [Rekanan](https://github.com/ivan17051/blud/blob/master/app/Rekanan.php))<br>

:cyclone: [to top](#contents)

## sp2d
Menampilkan PDF SP2D yang dapat di-_print_.

#### Parameters
Request, id: [Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php)

#### Return Value
[Report SP2D View](https://github.com/ivan17051/blud/blob/master/resources/views/report/sp2d.blade.php)<br>
with:<br>
&emsp;&emsp;[Transaksi](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bendahara: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Bendahara.php)<br>
&emsp;&emsp;Otorisator: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Unitkerja: [UnitKerja](https://github.com/ivan17051/blud/blob/master/app/Unitkerja.php)<br>
&emsp;&emsp;Request: Request<br>

:cyclone: [to top](#contents)

## espjToTransaksi
Membuat atau menyunting SPP-LS dari inputan satu atau lebih dari menu e-SPJ.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## lpjToTransaksi
Membuat atau menyunting SPP-GU dari inputan LPJ-UP. Proses tersebut dilakukan dengan mengisi field "transaksiterikat" pada tabel lpj dengan id transaksi SPP-GU yang baru dibuat.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## getSp2dInfo
Fungsi modular untuk mendapatkan informasi detil sp2d. Bisa menggunakan paremeter pada url sebagaimana pada contoh berikut:
`?fields=nomor,keterangan,status` , di mana akan menampilkan hasil queri dengan informasi fields tersebut.

#### Parameters
Request

#### Return Value
Response (JSON)

:cyclone: [to top](#contents)