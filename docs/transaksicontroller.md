## Transaksi Controller

:date: posted\: 09-02-2022

:memo: last updated\: 11-02-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

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

:cyclone: [to top](#contents)

## sptb

:cyclone: [to top](#contents)

## ceklist

:cyclone: [to top](#contents)

## spp

:cyclone: [to top](#contents)

## sppup

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


