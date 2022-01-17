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

    protected $fillable = [
        "tipe",
        "idgrup",
        "idunitkerja",
        "idrekening",
        "jenis",
        "jumlah",
        "saldo",
        "tanggal",
        "tanggalref",
        "riwayat",
        "status",
	    "isactive",
        "idc",
        "idm"
    ];

    public function unitkerja(){
        return $this->belongsTo(UnitKerja::class, 'idunitkerja');
    }

    public function rekening(){
        return $this->belongsTo(Rekening::class, 'idrekening');
    }

    public function subkegiatan(){
        return $this->hasOne(SubKegiatan::class, 'idgrup', 'idgrup');
    }
}
