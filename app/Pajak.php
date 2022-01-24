<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mpajak';

    public $timestamps = false;

    protected $fillable = [
        "kode",
        "nama",
        "parent",
        "isactive",
        "idc",
        "idm"
    ];
}
