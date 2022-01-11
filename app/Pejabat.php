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
        "kode",
        "nama",
        "nik",
        "nip",
        "golongan",
        "jabatan",
        "rekening",
	    "isactive",
        "idc",
        "idm"
    ];
}
