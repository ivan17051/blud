<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BKU extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bku';

    public $timestamps = false;

    protected $fillable = [
        "nomor",
        "tanggal",
        "idtransaksi",
        "idunitkerja",
        "idsubkegiatan",
        "idrekening",
        "tipe",
        "jenis",
        "KT",
        "SB",
        "PNJ",
        "PJK",
        "RO",
        "uraian",
        "nominal",
	    "isactive",
        "idc",
        "idm",
    ];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'idtransaksi');
    }

    public function rekening(){
        return $this->belongsTo(Rekening::class, 'idrekening');
    }
}
