<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi';

    public $timestamps = false;

    protected $casts = [
        'riwayat' => 'array',
        'rekening' => 'array',
   ];

    protected $fillable = [
        "tipe",
        "nomor",
        "idgrup",
        "idunitkerja",
        "rekening",
        "idkepada",
        "flagkepada",
        "jenis",
        "jumlah",
        "saldo",
        "tipepembukuan",
        "keterangan",
        "tanggal",
        "tanggalref",
        "riwayat",
        "status",
	    "isactive",
        "idc",
        "idm",
        "pesanpenolakan",
    ];

    public function unitkerja(){
        return $this->belongsTo(UnitKerja::class, 'idunitkerja');
    }

    public function subkegiatan(){
        return $this->hasOne(SubKegiatan::class, 'idgrup', 'idgrup');
    }
}
