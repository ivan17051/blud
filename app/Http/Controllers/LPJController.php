<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Datatables;
use App\Pejabat;
use App\UnitKerja;
use App\Transaksi;
use App\Rekanan;
use App\Saldo;
use App\SubKegiatan;
use App\Rekening;
use App\BKU;
use App\LPJ;

class LPJController extends Controller
{
    public function lpj(){
        $user = Auth::user();
        $unitKerja=UnitKerja::where('id',$user->idunitkerja)->select('id','nama','nama_alias')->get();
        $rekanan=Rekanan::where('isactive', 1)->where('idc',$user->id)->get();
        $subkegiatan=SubKegiatan::where('isactive', 1)->where('idunitkerja',$user->idunitkerja)->get();
        if(in_array($user->role,['admin','PIH'])){
            $spj = Transaksi::where('isspj', 1)->where('isactive', 1)->get();
        }else{
            $spj = Transaksi::where('isspj', 1)->where('isactive', 1)->where('idunitkerja',$user->idunitkerja)->get();
        }        
        
        return view('lpj', ['user' =>$user, 'unitkerja'=>$unitKerja, 'spj'=>$spj, 'rekanan'=>$rekanan, 'subkegiatan'=>$subkegiatan]);
    }

    public function data(Request $request){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = LPJ::where('isactive',1)->with(['unitkerja']);
        }else{
            $data = LPJ::where('isactive',1)->where('idunitkerja',$user->idunitkerja);
        }
        $datatable = Datatables::of($data);
        $datatable->addColumn('action', function ($t) { 
            return '<div class="text-nowrap">'.
                    '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info"><i class="fas fa-list fa-sm"></i></button>&nbsp'.
                    '<button onclick="show(this)" class="btn btn-sm btn-outline-danger border-0" title="info"><i class="fas fa-lock fa-sm"></i></button>'.
                    '</div>';
        })->editColumn('tipe', function ($t) { 
            switch ($t->tipe) {
                case 'TU':
                    return "<span class=\"badge bg-success text-white\">TU</span>";
                    break;
                case 'LS':
                    return "<span class=\"badge bg-primary text-white\">LS</span>";
                    break;
                case 'UP':
                    return "<span class=\"badge bg-info text-white\">UP</span>";
                    break;
            }
        })->editColumn('total', function ($t){
            return number_format($t->total,0,',','.');
        })->rawColumns(['tipe','action']);
        return $datatable->make(true);  
    }

    public function getRelatedBKU($idlpj){
        $data=BKU::where('isactive',1)->where('lpjparent', $idlpj)
            ->select('nomor','tanggalref','idtransaksi','idrekening','uraian','nominal')
            ->with(['transaksi:id,kodetransaksi,isspj', 'rekening:id,kode,nama']);
        $datatable = Datatables::of($data);
        return $datatable->make(true);
    }

    public function storeUpdateLPJ(Request $request){
        
    }

    public function deleteLPJ(Request $request){
        
    }
}
