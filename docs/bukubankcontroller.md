## Buku Bank Controller

:date: posted\: 18-03-2022

:memo: last updated\: 18-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [bukuBank](#bukubank)
- [bukuBankTable](#bukubanktable)
- [storeUpdateBukuBank](#storeupdatebukubank)
- [delete](#delete)
- [storeUpdateSaldo](#storeupdatesaldo)
- [cetak](#cetak)

## bukuBank
Menampilkan tampilan bukuBank.blade.php dengan filter bulan saat ini

#### Parameters

#### Return Value
[Buku Bank View](https://github.com/ivan17051/blud/blob/master/resources/views/bukuBank.blade.php)<br>
with:<br>
&emsp;&emsp;[Buku Bank](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bulan: Carbon::now()<br>
&emsp;&emsp;PKM: Auth::user()<br>
&emsp;&emsp;[Saldo Awal](https://github.com/ivan17051/blud/blob/master/app/SaldoBukuBank.php): Collection<br>

:cyclone: [to top](#contents)

## bukuBankTable
Menampilkan tampilan bukuBank.blade.php dengan filter bulan saat ini dan puskesmas yang dipilih

#### Parameters
Request

#### Return Value
[Buku Bank View](https://github.com/ivan17051/blud/blob/master/resources/views/bukuBank.blade.php)<br>
with:<br>
&emsp;&emsp;[Buku Bank](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bulan: Carbon::now()<br>
&emsp;&emsp;PKM: Auth::user()<br>
&emsp;&emsp;[Saldo Awal](https://github.com/ivan17051/blud/blob/master/app/SaldoBukuBank.php): Collection<br>

:cyclone: [to top](#contents)

## storeUpdateBukuBank
Menyimpan data baru ataupun data hasil edit dari _user_

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## delete
_Soft delete_ data Buku Bank dari tabel **bukuBank** dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## storeUpdateSaldo
Menyimpan data Saldo baru ataupun data Saldo hasil edit dari _user_

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## cetak
Melakukan cetak terhadap laporan Buku Bank yang sudah dibuat _user_

#### Parameters
Request

#### Return Value
[Report Buku Bank](https://github.com/ivan17051/blud/blob/master/resources/views/report/bukubank.blade.php)<br>
with:<br>
&emsp;&emsp;[Buku Bank](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bulan: Carbon::now()<br>
&emsp;&emsp;PKM: Auth::user()<br>
&emsp;&emsp;[Saldo Awal](https://github.com/ivan17051/blud/blob/master/app/SaldoBukuBank.php): Collection<br>

:cyclone: [to top](#contents)