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
            ->addIndexColumn()
            ->editColumn('tipe', function ($t) { 
                return $t->tipe==='TU'?
                    "<span class=\"badge bg-success text-white\">TU</span>":
                    "<span class=\"badge bg-primary text-white\">LS</span>";
            })
            ->editColumn('jenis', function ($t) { 
                return $t->jenis===1?"<p class=\"text-info\"><b>debit</b></p>":"<p class=\"text-warning\"><b>kredit</b></p>";
            })
            ->addColumn('action', function ($t) { 
                return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" data-toggle="modal" data-target="#show" data-placement="top" title="info"><i class="fas fa-info fa-sm"></i></button>';
            })
            ->addColumn('status_raw', function ($t) {
                return $t->status;
            })
            ->editColumn('jumlah', function ($t){
                return number_format($t->jumlah,2,',','.');
            })
            ->editColumn('status', function ($t) { 
                switch ($t->status) {
                    case 0:
                        return '<button class="btn btn-sm btn-outline-dark border-0" title="acc"><i class="fas fa-hourglass-half fa-sm"></i>&nbsp belum</button>';
                        break;
                    case 1:
                        return '<button class="btn btn-sm btn-warning border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp ppd</button>';
                        break;
                    case 2:
                        return '<button class="btn btn-sm btn-info border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp sopd</button>';
                        break;
                    case 2:
                        return '<button class="btn btn-sm btn-success border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp spd</button>';
                        break;
                    default:
                        return '';
                }
            })
            ->rawColumns(['tipe','jenis','status','action']);
        return $datatable->make(true);  
    }

    public function storeUpdateTransaksi(Request $request){
        
    }
}
