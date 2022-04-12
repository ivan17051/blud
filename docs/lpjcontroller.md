## LPJ Controller

:date: posted\: 21-03-2022

:memo: last updated\: 12-04-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [lpj](#lpj)
- [data](#data)
- [getBKUByPeriod](#getbkubyperiod)
- [storeUpdateLPJ_UP](#storeupdatelpj_up)
- [storeUpdateLPJ_TU](#storeupdatelpj_tu)
- [deleteLPJ](#deletelpj)
- [getLPJ](#getlpj)

## lpj 
Menampilkan halaman daftar lpj yang telah diinput.

#### Return Value
[LPJ View](https://github.com/ivan17051/blud/blob/master/resources/views/lpj.blade.php)<br>
with:<br>
&emsp;&emsp;[User](https://github.com/ivan17051/blud/blob/master/app/User.php)<br>
&emsp;&emsp;[SubKegiatan](https://github.com/ivan17051/blud/blob/master/app/SubKegiatan.php): Collections<br>
&emsp;&emsp;[Transaksi](#https://github.com/ivan17051/blud/blob/master/app/Pajak.php): Collections

:cyclone: [to top](#contents)

## data
Menampilkan tabel pada halaman lpj.blade.php melalui request ajax.

#### Parameters
Request

#### Return Value
Datatable<br>

:cyclone: [to top](#contents)

## getBKUByPeriod
Mendapatkan data BKU berdasar informasi subkegiatan, tipe, bulan, dan tahun melalui request ajax.

#### Parameters
Request, subkegiatan, tipe, month, year

#### Return Value
Datatable<br>

:cyclone: [to top](#contents)

## storeUpdateLPJ_UP
Menyimpan atau memperbarui data LPJ dengan tipe UP dimana field `total` diisi dengan total BKU-UP pada bulan dan tahun tertentu.

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## storeUpdateLPJ_TU
Menyimpan atau memperbarui data LPJ dengan tipe TU dimana LPJ tersebut terikat dengan data Transaksi bertipe TU juga. Field `total` diisi dari total rekening pada data Transaksi tersebut.

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## deleteLPJ
_Soft delete_ data LPJ dari tabel **lpj** dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## getLPJ
_Soft delete_ data LPJ dari tabel **lpj** dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)