<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi';

    public $timestamps = false;

    protected $casts = [
        'riwayat' => 'array',
        'rekening' => 'array',
        'pajak' => 'array',
        'potongan' => 'array',
        'ceklist' => 'array',
   ];

    protected $fillable = [
        "tipe",
        "nomor",
        "idunitkerja",
        "idsubkegiatan",
        "kodetransaksi",
        "kodepekerjaan",
        "isspj",
        "isbku",
        "rekening",
        "idkepada",
        "flagkepada",
        "jenis",
        "jumlah",
        "saldo",
        "tipepembukuan",
        "keterangan",
        "tanggal",
        "tanggalref",
        "riwayat",
        "pajak",
        "potongan",
        "nocek",
        "tanggalcek",
        "status",
	    "isactive",
        "idc",
        "idm",
        "pesanpenolakan",
    ];

    public function unitkerja(){
        return $this->belongsTo(UnitKerja::class, 'idunitkerja');
    }

    public function subkegiatan(){
        return $this->belongsTo(SubKegiatan::class, 'idsubkegiatan');
    }

    public function children(){
        return $this->hasMany(Transaksi::class, 'parent')->select('id','kodetransaksi','parent');
    }
}
