<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'munitkerja';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "kode",
	    "nama_alias",
        "alamat",
        "idc",
        "idm"
    ];
}
