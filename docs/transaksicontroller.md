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
[Transaksi View](#4)<br>
with:<br>
&emsp;&emsp;[SubKegiatan](#3): Collections<br>
&emsp;&emsp;[Rekening](#3): Collections<br>
&emsp;&emsp;[User](#4): Collections<br>
&emsp;&emsp;[Pejabat](#5): Collections<br>
&emsp;&emsp;[Pajak](#6): Collections

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

:cyclone: [to top](#contents)

## sp2d

:cyclone: [to top](#contents)

## espjToTransaksi

:cyclone: [to top](#contents)


