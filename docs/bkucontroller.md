## BKU Controller

:date: posted\: 09-02-2022

:memo: last updated\: 21-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [index](#index)
- [data](#data)
- [storeUpdateBKU](#storeupdatebku)
- [deleteBKU](#deletebku)
- [transaksiToBKU](#transaksitobku)
- [cetak](#cetak)
- [getSPP](#getspp)

## index
Menampilkan halaman daftar BKU. BKU dapat menarik dari data transaksi bertipe LS dan dari data input e-SPJ. 

#### Return Value
[BKU View](https://github.com/ivan17051/blud/blob/master/resources/views/bku.blade.php)<br>
with:<br>
&emsp;&emsp;[User](https://github.com/ivan17051/blud/blob/master/app/User.php)<br>
&emsp;&emsp;[SubKegiatan](https://github.com/ivan17051/blud/blob/master/app/SubKegiatan.php): Collections<br>
&emsp;&emsp;[Rekening](https://github.com/ivan17051/blud/blob/master/app/Rekening.php): Collections<br>
&emsp;&emsp;[UnitKerja](https://github.com/ivan17051/blud/blob/master/app/UnitKerja.php)<br>

:cyclone: [to top](#contents)

## data
Menarik data BKU dari tabel **bku** dan menghasilkan queri _Datatable server side_.

#### Return Value
Datatables

:cyclone: [to top](#contents)

## storeUpdateBKU
Menyimpan data BKU baru atau data BKU yang diubah ke tabel **bku**. PROSES HANYA UNTUK BKU DENGAN PROSES TAMBAH NORMAL.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## deleteBKU
_Soft delete_ data BKU dari tabel **bku** dengan merubah properti **isactive** = 0.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## transaksiToBKU
Fungsi menambah BKU melalui tarikan dari Transaksi SP2D bertipe LS atau juga melalui tarikan dari data e-SPJ. **CATATAN**: KHUSUS BKU YANG BERASAL DARI SP2D-LS, AKAN DIBUAT MENJADI 2 BKU BERJENIS PENERIMAAN DAN PENGELUARAN.

#### Parameters
Request

#### Return Value
Redirect

:cyclone: [to top](#contents)

## cetak
Menampilkan BKU yang dapat diprint

#### Parameters
Request, idunitkerja: [UnitKerja](https://github.com/ivan17051/blud/blob/master/app/UnitKerja.php), month: [Integer]

#### Return Value
[Report BKU View](https://github.com/ivan17051/blud/blob/master/resources/views/report/bku.blade.php)<br>
with:<br>
&emsp;&emsp;[BKU](https://github.com/ivan17051/blud/blob/master/app/BKU.php): Collections<br>
&emsp;&emsp;[UnitKerja](https://github.com/ivan17051/blud/blob/master/app/UnitKerja.php)<br>

:cyclone: [to top](#contents)

## getSPP
Fungsi modular untuk memunculkan daftar spp dengan output queri _Datatable server side_. Bisa menggunakan parameter berikut:
`?upls=LS&status=3&isspj=1&parent=12` , di mana akan menampilkan hasil queri data transaksi yang bertipe LS, memiliki status bernilai 3 (sp2d terbit), transaksi berasal dari data tarikan e-SPJ, dan data BKU yang berasal dari transaksi SP2D dengan id 12.

#### Parameters
Request

#### Return Value
Datatables

:cyclone: [to top](#contents)
