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
        $subkegiatan=[];
        $rekening=[];
        if (in_array($user->role, ['PKM'])) {
            $subkegiatan=SubKegiatan::where('isactive', 1)->where('idunitkerja', Auth::user()->idunitkerja)->get();
            $rekening=Rekening::where('isactive', 1)->with(['saldo'=>function($q){
                $q->select('id','idunitkerja','idrekening','saldo')->orderBy('tanggal','DESC')->first();
            }])->select('id','kode','nama')->get();
        }
        return view('bku', [ 'user'=>$user, 'subkegiatan'=>$subkegiatan, 'rekening'=>$rekening ]);
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
                if($t->nominal < 0){
                    return '('.number_format($t->nominal*-1,0,',','.').')';
                }else{
                    return number_format($t->nominal,0,',','.');
                }
            })
            ->addColumn('jenis_raw', function($t){
                return $t->jenis;
            })
            ->addColumn('KT_raw', function($t){
                return $t->KT;
            })
            ->addColumn('SB_raw', function($t){
                return $t->SB;
            })
            ->addColumn('PNJ_raw', function($t){
                return $t->PNJ;
            })
            ->addColumn('PJK_raw', function($t){
                return $t->PJK;
            })
            ->addColumn('RO_raw', function($t){
                return $t->RO;
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
                if(isset($t->transaksi->nomor)===FALSE){
                    return '<button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Transaksi" ><i class="fas fa-edit fa-sm"></i></button>'.
                        '<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" style="width:2rem;" title="Hapus Transaksi"><i class="fas fa-trash fa-sm"></i></button>';
                }
                return '<button class="btn btn-outline-default border-0" disabled><i class="fas fa-lock"></i></a>';
            })
            ->rawColumns(['jenis','KT','SB','PNJ','PJK','RO','action']);
        return $datatable->addIndexColumn()->make(true);
    }

    public function storeUpdateBKU(Request $request){
        $user = Auth::user();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:bku,id',
            "KT" => 'required_without_all:SB,PNJ,RO,PJK|integer',
            "SB" => 'required_without_all:KT,PNJ,RO,PJK|integer',
            "PNJ" => 'required_without_all:KT,SB,RO,PJK|integer',
            "RO" => 'required_without_all:KT,SB,PNJ,PJK|integer',
            "PJK" => 'required_without_all:KT,SB,PNJ,RO|integer',
            "keterangan" => "nullable|string",
            "jenis" => "required_without:id|in:0,1",
            "nomorsp2d" => "required_without:id|string",
            "tanggal" => "required_without:id|string",
            "tanggalref" => "required_without:id|string",
            "tipe" => "required_without:id|string",
            "idsubkegiatan" => "required_without:id",
            "idrekening" => "required_without:id",
            "uraian" => "required_without:id",
            "nominal" => array('required_without:id','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();

        if(isset($input['nomorsp2d'])){
            $nomor=intval($input['nomorsp2d']);
            $input['nomorsp2d']=substr(str_repeat(0, 5).strval($nomor), - 5);
        }
        
        if(isset($input['id'])){
            $bku=BKU::find($input['id']);
            $bku->fill([
                'idm'=>$user->id,
            ]);
        }else{
            $year=Carbon::parse($input['tanggal'])->year;
            $bku_aktual=BKU::select('id','nomor')
                ->where('isactive',1)
                ->whereYear('tanggal',$year)
                ->orderBy('id', 'DESC')
                ->where('idunitkerja',$user->idunitkerja)->first();
            if(isset($bku_aktual)){
                $nomor=intval($bku_aktual->nomor)+1;
            }else{
                $nomor=1;
            }
            $bku = new BKU();
            $bku->fill([
                'nomor'=> substr(str_repeat(0, 5).strval($nomor), - 5),   //convert agar nomor ada leading zero
                'idc'=>$user->id,
                'idm'=>$user->id,
                'idunitkerja'=>$user->idunitkerja,
            ]);
        }
        $bku->fill($input);
        $bku->save();
        return back()->with('success','Berhasil Menyimpan.');
    }

    public function deleteBKU(Request $request){
        $user = Auth::user();
        $userId = $user->id;
        try {
            $model=BKU::find($request->input('id'));
            if($user->idunitkerja !== $model->idunitkerja
                OR isset($model->idtransaksi)){
                throw new \Exception("restricted");
            }
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
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

            // LOOP ke Rekening yg ada di row transaksi
            foreach ($model->rekening as $i => $rekeningArr) {
                $bku = new BKU();
                $bku->fill($input);
                $bku->fill($model->toArray());
                $bku->fill([
                    'keterangan'=> NULL,
                    'nominal'=> $rekeningArr[3],
                    'idrekening'=> $rekeningArr[0],
                    'nomor'=> substr(str_repeat(0, 5).strval($nomor), - 5),   //convert agar nomor ada leading zero
                    'uraian'=> $model->keterangan,
                    'tanggal'=> isset($input['tanggal']) ? $input['tanggal'] : $model->tanggalref,
                    'idc'=>$user->id,
                    'idm'=>$user->id,
                ]);


                // Rekening LS pasti masuk Buku Pembantu RO
                $bku->fill([
                    'RO'=> 1,
                ]);
                $bku->save();
                $nomor+=1; 

                //kalau tipe LS bikin 2, yaitu penerimaan dan pengeluaran
                if($model->tipe==='LS'){
                    $bku=$bku->replicate();
                    $bku->fill([
                        'jenis'=> $bku->jenis===0 ? 1 : 0,
                        'nomor'=> substr(str_repeat(0, 5).strval($nomor), - 5),   //convert agar nomor ada leading zero
                    ]);
                    $bku->save();
                    $nomor+=1; 
                }
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

    public function getSPP(Request $request){
        if(isset($request->upls)==False) return abort(404);
        $user = Auth::user();
        $upls = explode(',',$request->upls);
        $data = Transaksi::where('isactive',1)->with(['subkegiatan'])
                ->select('id', 'nomor', 'tipe', 'idunitkerja', 'idsubkegiatan', 'tanggalref', 'keterangan', 'kodetransaksi')
                ->where('idunitkerja',$user->idunitkerja)
                ->where('isbku',0)
                ->whereIn('tipe',$upls);

        if(isset($request->status)){
            $data->where('status',$request->status);     //sp2d sudah muncul
        }

        if(isset($request->isspj)){
            $data->where('isspj',$request->isspj);     //isspj
        }

        if(isset($request->nomor)){
            $nomor = $request->nomor=='NULL'? null : $request->nomor;
            $data->where('nomor',$nomor);     //nomor
        }

        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }
}
