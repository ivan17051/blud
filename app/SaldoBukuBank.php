<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaldoBukuBank extends Model
{
    protected $table = 'saldobb';

    protected $fillable = [
	    "tanggal",
        "idunitkerja",
        "jenis",
        "nominal",
        "idc",
        "idm"
    ];
}
