<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mpejabat';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "nik",
        "nip",
        "golongan",
        "jabatan",
        "rekening",
        "idunitkerja",
	    "isactive",
        "idc",
        "idm"
    ];
}
