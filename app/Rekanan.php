<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mrekanan';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "alamat",
        "pimpinan",
        "namabank",
        "rekening",
        "npwp",
	    "isactive",
        "idc",
        "idm"
    ];
}
