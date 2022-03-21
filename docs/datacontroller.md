## Data Controller

:date: posted\: 18-03-2022

:memo: last updated\: 21-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

| **Base**                   | **Store and Update**    | **Delete**
|----------------------------|-------------------------|-----------------
| [dashboard](#dashboard)    |                         |
| [unitKerja](#viewdata)     |                         |
| [kegiatan](#viewdata)      | [storeUpdateKegiatan](#createupdatedata)   | [deleteKegiatan](#deldata)
| [subkegiatan](#viewdata)   | [storeUpdateSubkegiatan](#createupdatedata)| [deleteSubkegiatan](#deldata)
| [rekening](#viewdata)      | [storeUpdateRekening](#createupdatedata)   | [deleteRekening](#deldata)
| [pejabat](#viewdata)       | [storeUpdatePejabat](#createupdatedata)    | [deletePejabat](#deldata)
| [rekanan](#viewdata)       | [storeUpdateRekanan](#createupdatedata)    | [deleteRekanan](#deldata)
| [user](#viewdata)          | [storeUpdateUser](#createupdatedata)       | [deleteUser](#deldata)
| [saldo](#viewdata)         | [storeUpdateSaldo](#createupdatedata)      | 
| [saldoTable](#viewdata)    | [storeUpdateSaldoTable](#createupdatedata) | 
| [pajak](#viewdata)         | [storeUpdatePajak](#createupdatedata)      | [deletePajak](#deldata)

## dashboard
Menampilkan halaman utama

#### Parameters

#### Return Value
[Dashboard View](https://github.com/ivan17051/blud/blob/master/resources/views/dashboard.blade.php)<br>

:cyclone: [to top](#contents)

## ViewData
Menampilkan halaman dengan isi tabel sesuai dengan data yang dipilih _user_

#### Parameters

#### Return Value
[View Master Data](https://github.com/ivan17051/blud/blob/master/resources/views/masterData)<br>
with:<br>
&emsp;&emsp;[Modal Data Master](https://github.com/ivan17051/blud/blob/master/app): Collections<br>

:cyclone: [to top](#contents)

## CreateUpdateData
Menyimpan data yang sudah diinputkan atau diubah oleh _user_

#### Parameters
Request

#### Return Value
Redirect<br>
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)

## DelData
_Soft delete_ data dari tabel dengan merubah properti **isactive** = 0.
#### Parameters
Request

#### Return Value
Redirect
with:<br>
&emsp;&emsp;Success/Error: Alert<br>

:cyclone: [to top](#contents)
