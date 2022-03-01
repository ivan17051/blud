<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaldoBukuBank extends Model
{
    protected $table = 'saldobb';

    public $timestamps = false;

    protected $fillable = [
	    "tanggal",
        "idunitkerja",
        "jenis",
        "nominal",
        "idc",
        "idm"
    ];
}
