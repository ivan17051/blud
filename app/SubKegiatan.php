<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'msubkegiatan';

    public $timestamps = false;

    protected $fillable = [
        "idkegiatan",
        "kode",
        "nama",
        "tahun",
	    "isactive",
        "idc",
        "idm"
    ];

    public function getKegiatan(){
        return $this->belongsTo(Kegiatan::class, 'idkegiatan');
    }
}
