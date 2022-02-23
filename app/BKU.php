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
        "nomorsp2d",
        "tanggal",
        "tanggalref",
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
        "keterangan",
        "nominal",
	    "isactive",
        "idc",
        "idm",
        "lpjparent",
    ];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'idtransaksi');
    }

    public function rekening(){
        return $this->belongsTo(Rekening::class, 'idrekening');
    }
}
