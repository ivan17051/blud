<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mkegiatan';

    public $timestamps = false;

    protected $fillable = [
        "kode",
        "nama",
	    "isactive",
        "idc",
        "idm"
    ];
}
