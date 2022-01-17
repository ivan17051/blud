<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UnitKerja;
use App\Kegiatan;
use App\SubKegiatan;
use App\Pejabat;
use App\Rekanan;
use App\Rekening;
use App\User;
use App\Saldo;
use App\Transaksi;
use Datatables;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(){
        return view('transaksi');
    }

    public function data(Request $request){
        $data = Transaksi::where('isactive',1)->with(['unitkerja','rekening','subkegiatan']);
        $datatable = Datatables::of($data);
        $datatable->editColumn('tanggalref', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->editColumn('jenis', function ($t) { return $t->jenis===1?'<b>debit<b>':'<b>kredit<b>';})
            ->addColumn('action', function ($t) { 
                return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" data-toggle="modal" data-target="#show" data-placement="top" title="info"><i class="fas fa-info fa-sm"></i></button>';
            });
        return $datatable->make(true);  
    }
}
