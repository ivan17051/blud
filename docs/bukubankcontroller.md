## Buku Bank Controller

:date: posted\: 18-03-2022

:memo: last updated\: 18-03-2022

:house: [to home](https://github.com/ivan17051/blud/blob/master/README.md)

#### Contents

- [bukuBank](#showceklist)
- [bukuBankTable](#filterformulironchange)
- [storeUpdateBukuBank](#hapus)
- [delete](#show)
- [storeUpdateSaldo](#tolak)
- [cetak](#acc)

## showCeklist
Menampilkan modal yang berisi Ceklist sesuai dengan pilihan UPLS(UP, LS, TU)

#### Parameters
e: Self

#### Return Value
Modal Ceklist<br>
with:<br>
&emsp;&emsp;Ceklist: HTML<br>

:cyclone: [to top](#contents)

## filterFormulirOnChange
Menampilkan pilihan yang dinamis sesuai dengan pilihan sebelumnya

#### Parameters
e: Self

#### Return Value
Select<br>
with:<br>
&emsp;&emsp;Bendahara: [Pejabat](https://github.com/ivan17051/blud/blob/master/app/Pejabat.php)<br>
&emsp;&emsp;Rekanan: [Rekanan](https://github.com/ivan17051/blud/blob/master/app/Rekanan.php)<br>

:cyclone: [to top](#contents)

## hapus
Menampilkan modal untuk konfirmasi hapus data transaksi dan menghapus data transaksi

#### Parameters
e: Self

#### Return Value
Swal: Modal<br>
with:<br>
&emsp;&emsp;Form Delete: Submit<br>

:cyclone: [to top](#contents)

## show
Menampilkan data rekening, informasi, dan potongan pada baris data yang dipilih

#### Parameters
e: Self

#### Return Value
Show Child<br>

:cyclone: [to top](#contents)

## tolak
Menolak pengajuan SP2D dengan mengubah status transaksi menjadi = 4

#### Parameters
e: Self

#### Return Value
Swal: Modal<br>
with:<br>
&emsp;&emsp;Form Delete: Submit<br>

:cyclone: [to top](#contents)

## acc
Meng-_acc_ pengajuan SP2D dengan mengubah status transaksi menjadi = 3

#### Parameters
e: Self

#### Return Value
Swal: Modal<br>
with:<br>
&emsp;&emsp;Form Acc: Submit<br>

:cyclone: [to top](#contents)

## buatSpm
Menampilkan modal untuk konfirmasi pembuatan SPM dengan mengubah status transaksi menjadi = 1 dan meminta inputan jenis pembukuan dan sumber dana dari _user_.

#### Parameters
e: Self

#### Return Value
Swal: Modal<br>
with:<br>
&emsp;&emsp;Form Acc: Submit<br>

:cyclone: [to top](#contents)

## batal
Membatalkan permintaan user untuk melakukan _forward_ data transaksi ke SP2D.

#### Parameters
e: Self

#### Return Value
Swal: Modal<br>
with:<br>
&emsp;&emsp;Form Batal: Submit<br>

:cyclone: [to top](#contents)

## cetak
Mencetak laporan sesuai dengan permintaan _user_.

#### Parameters
type, id, tipepembukuan=null, nocek, tipe, listCek

#### Return Value
Action: Attribute<br>
Swal: Modal<br>

:cyclone: [to top](#contents)

## edit
Memasukkan 1 baris data yang telah dipilih oleh _user_ pada modal _edit_.

#### Parameters
e: Self

#### Return Value
Value: Attribute<br>

:cyclone: [to top](#contents)

## ubahRek
Menampilkan modal untuk melakukan perubahan pada data rekening(menambah atau menghapus) dari satu transaksi.

#### Parameters
idtransaksi

#### Return Value
Value: HTML<br>

:cyclone: [to top](#contents)

## ubahPajak
Menampilkan modal untuk melakukan perubahan pada data pajak(menambah atau menghapus) dari satu transaksi.

#### Parameters
idtransaksi

#### Return Value
Value: HTML<br>

:cyclone: [to top](#contents)

## ubahPotongan
Menampilkan modal untuk melakukan perubahan pada data potongan(menambah atau menghapus) dari satu transaksi.

#### Parameters
idtransaksi

#### Return Value
Value: HTML<br>

:cyclone: [to top](#contents)

## format
Membuat tampilan tabel rekening, informasi, dan potongan pada setiap baris data transaksi.

#### Parameters
data

#### Return Value
Value: HTML<br>

:cyclone: [to top](#contents)

## infoSaldo
Menampilkan sisa saldo dari rekening yang dipilih.

#### Parameters
self, target

#### Return Value
Value: Attribute<br>

:cyclone: [to top](#contents)

## openPilihSPP
Membuat tampilan tabel rekening, informasi, dan potongan pada setiap baris data transaksi.

#### Parameters
data

#### Return Value
Value: HTML<br>

:cyclone: [to top](#contents)

## pilih_espj_ls

:cyclone: [to top](#contents)

## pilih_multi_espj

:cyclone: [to top](#contents)

## submit_espj_ls

:cyclone: [to top](#contents)

## select_espj_terpilih

:cyclone: [to top](#contents)

## edit_pilihan_espj_ls

:cyclone: [to top](#contents)