<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mrekening';

    public $timestamps = false;

    protected $fillable = [
        "kode",
        "nama",
	    "isactive",
        "idc",
        "idm"
    ];

    /**
     * The saldo that belong to the Rekening
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function saldo()
    {
        return $this->hasMany(Saldo::class, 'idrekening');
    }

    public function saldoawal()
    {
        return $this->hasOne(Saldo::class, 'idrekening')->where('tipe', 'saldo awal');
    }
}
