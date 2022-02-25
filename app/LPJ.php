<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LPJ extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lpj';

    public $timestamps = false;

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
   ];

    protected $fillable = [
        "nomor",
        "tanggal",
        "tipe",
        "idunitkerja",
        "total",
	    "isactive",
        "idc",
        "idm",
    ];
}
