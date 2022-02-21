<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuBank extends Model
{
    protected $table = 'bukubank';

    protected $fillable = [
        "noref",
        "tanggalref",
        "tanggal",
        "idunitkerja",
        "jenis",
        "uraian",
        "nominal",
	    "isactive",
        "idc",
        "idm",
    ];
}
