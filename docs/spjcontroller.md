## SPJ Controller

:date: posted\: 21-03-2022

:memo: last updated\: 21-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [spj](#spj)
- [data](#data)
- [storeUpdateSPJ](#storeupdatespj)
- [deleteSPJ](#deletespj)

## spj
Menampilkan halaman spj.blade.php

#### Parameters

#### Return Value
[SPJ View](https://github.com/ivan17051/blud/blob/master/resources/views/spj.blade.php)<br>
with:<br>
&emsp;&emsp;User: Auth::user()<br>
&emsp;&emsp;[Unit Kerja](https://github.com/ivan17051/blud/blob/master/app/UnitKerja.php): Collections<br>
&emsp;&emsp;[Rekanan](https://github.com/ivan17051/blud/blob/master/app/Rekanan.php): Collections<br>
&emsp;&emsp;[Rekening](https://github.com/ivan17051/blud/blob/master/app/Rekening.php): Collections<br>

:cyclone: [to top](#contents)

## data
Menampilkan tabel pada halaman spj.blade.php

#### Parameters
Request

#### Return Value
Datatable<br>

:cyclone: [to top](#contents)

## storeUpdateSPJ
Menyimpan data baru ataupun data hasil edit dari _user_

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## deleteSPJ
_Soft delete_ data SPJ dari tabel **spj** dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)
