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
use App\Pajak;
use App\BKU;
use Datatables;
use Carbon\Carbon;
use PDF;
use Validator;
use Illuminate\Support\Facades\DB;

class BkuController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('bku', [ 'user'=>$user ]);
    }

    public function data(){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = BKU::where('isactive',1)
                ->with(['transaksi'=>function($q){
                    $q->select('id','nomor','isspj','isbku');
                }])
                ->with(['rekening'=>function($q){
                    $q->select('id','kode','nama');
                }]);
        }else{
            $data = BKU::where('isactive',1)
                ->with(['transaksi'=>function($q){
                    $q->select('id','nomor','isspj','isbku');
                }])
                ->with(['rekening'=>function($q){
                    $q->select('id','kode','nama');
                }])
                ->where('idunitkerja',$user->idunitkerja);
        }
        $datatable = Datatables::of($data);
        $datatable
            ->editColumn('nominal', function ($t){
                return number_format($t->nominal,0,',','.');
            })
            ->editColumn('jenis', function($t){
                if($t->jenis==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-level-down-alt"></i></a>';
                else return '<a href="javascript:void(0)" class="text-info fs-20"><i class="fas fa-level-up-alt"></i></a>';
            })
            ->editColumn('KT', function($t){
                if($t->KT==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-check"></i></a>';
                return '';
            })
            ->editColumn('SB', function($t){
                if($t->SB==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-check"></i></a>';
                return '';
            })
            ->editColumn('PNJ', function($t){
                if($t->PNJ==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-check"></i></a>';
                return '';
            })
            ->editColumn('PJK', function($t){
                if($t->PJK==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-check"></i></a>';
                return '';
            })
            ->editColumn('RO', function($t){
                if($t->RO==1) return '<a href="javascript:void(0)" class="text-success fs-20"><i class="fas fa-check"></i></a>';
                return '';
            })
            ->addColumn('action', function($t){
                return '<button class="btn btn-outline-default border-0" disabled><i class="fas fa-lock"></i></a>';
            })
            ->rawColumns(['jenis','KT','SB','PNJ','PJK','RO','action']);
        return $datatable->addIndexColumn()->make(true);
    }

    public function storeUpdateBKU(Request $request){

    }

    public function transaksiToBKU(Request $request){
        $user = Auth::user();
        $input = $request->all();
        
        $idtransaksi=$input['idtransaksi'];
        
        $model=Transaksi::where('id',$idtransaksi)
            ->where('isbku',0)
            ->select('id','tanggalref', 'idunitkerja', 'idsubkegiatan', 'tipe', 'jenis', 'keterangan', 'rekening')->first();

        if(isset($model)===FALSE){
            return back()->with('error','ID transaksi tidak ditemukan.');
        }elseif ($model->idunitkerja !== $user->idunitkerja) {
            return back()->with('error','Tidak berhak.');
        }

        try {
            DB::beginTransaction();
            $year=Carbon::parse($model->tanggalref)->year;
            $bku_aktual=BKU::select('id','nomor')
                ->where('isactive',1)
                ->whereYear('tanggal',$year)
                ->orderBy('id', 'DESC')
                ->where('idunitkerja',$model->idunitkerja)->first();
            if(isset($bku_aktual)){
                $nomor=intval($bku_aktual->nomor)+1;
            }else{
                $nomor=1;
            }

            foreach ($model->rekening as $i => $rekeningArr) {
                $bku = new BKU();
                $bku->fill($input);
                $bku->fill($model->toArray());
                $bku->fill([
                    'nominal'=> $rekeningArr[3],
                    'idrekening'=> $rekeningArr[0],
                    'nomor'=> substr(str_repeat(0, 5).strval($nomor), - 5),   //convert agar nomor ada leading zero
                    'uraian'=> $model->keterangan,
                    'tanggal'=> $model->tanggalref,
                    'idc'=>$user->id,
                    'idm'=>$user->id,
                ]);
                $bku->save();
                
                $nomor+=1; 
            }
            $model->fill([
                'isbku' => 1
            ]);
            $model->save();
            DB::commit();
            return back()->with('success','Berhasil membuat BKU.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error','Gagal memproses.');
        }
        
    }

    public function cetak(Request $request, $idunitkerja, $bulan){
        $user = Auth::user();
        $unitkerja=UnitKerja::where('id',$idunitkerja)->select('id','kode','nama')->first();
        $bku = BKU::where('isactive',1)
                ->with(['transaksi'=>function($q){
                    $q->select('id','nomor','isspj','isbku');
                }])
                ->where('idunitkerja',$idunitkerja)
                ->whereMonth('tanggal',$bulan)
                ->orderBy('id','ASC')->get();
        return view('report.bku', ['bku'=>$bku, 'unitkerja'=>$unitkerja]);
    }
}
