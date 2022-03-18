## Data Controller

:date: posted\: 18-03-2022

:memo: last updated\: 18-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [dashboard](#dashboard)
- [unitKerja](#unitkerja)
<style>
  table{
    width: 100%;
  }
</style>

| **Base**                    | **Store and Update**    |
|-----------------------------|-------------------------|
| [kegiatan](#kegiatan)       | [storeUpdateKegiatan](#storeupdatekegiatan)     |
| [subkegiatan](#subkegiatan) | [storeUpdateSubkegiatan](#storeupdatesubkegiatan)  |
| [rekening](#rekening)       | [storeUpdateRekening](#storeupdaterekening)     |
| [pejabat](#pejabat)         | [storeUpdatePejabat](#storeupdatepejabat)      |
| [rekanan](#rekanan)         | [storeUpdateRekanan](#storeupdaterekanan)      |
| [user](#user)               | [storeUpdateUser](#storeupdateuser)         |
| [saldo](#saldo)             | [storeUpdateSaldo](#storeupdatesaldo)        |
| [saldoTable](#saldotable)   | [storeUpdateSaldoTable](#storeupdatesaldotable)   |
| [pajak](#pajak)             | [storeUpdatePajak](#storeupdatepajak)        |

## dashboard
Menampilkan tampilan halaman utama

#### Parameters

#### Return Value
[Buku Bank View](https://github.com/ivan17051/blud/blob/master/resources/views/bukuBank.blade.php)<br>
with:<br>
&emsp;&emsp;[Buku Bank](https://github.com/ivan17051/blud/blob/master/app/Transaksi.php): Collections<br>
&emsp;&emsp;Bulan: Carbon::now()<br>
&emsp;&emsp;PKM: Auth::user()<br>
&emsp;&emsp;[Saldo Awal](https://github.com/ivan17051/blud/blob/master/app/SaldoBukuBank.php): Collection<br>

:cyclone: [to top](#contents)

