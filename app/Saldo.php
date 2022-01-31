<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'msaldo';

    public $timestamps = false;

    protected $fillable = [
	    "idunitkerja",
        "idrekening",
        "saldo",
        "tanggal",
        "tipe",
        "keterangan",
        "idc",
        "idm"
    ];

    public function rekening(){
        return $this->hasOne(Rekening::class, 'idrekening');
    }
}
