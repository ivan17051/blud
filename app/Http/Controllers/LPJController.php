<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\DB;
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
            $data = LPJ::where('isactive',1)->with(['subkegiatan:id,idunitkerja,nama','subkegiatan.unitkerja:id,nama']);
        }else{
            $data = LPJ::where('isactive',1)->with(['subkegiatan'=>function($q) use($user){
                $q->select('id','idunitkerja','nama')->where('idunitkerja',$user->idunitkerja);
            },'subkegiatan.unitkerja:id,nama']);
        }
        $datatable = Datatables::of($data);
        $datatable->addColumn('action', function ($t) { 
            if(isset($t->transaksiterikat)){
                return '<button disabled class="btn btn-sm btn-outline-default border-0" title="lock"><i class="fas fa-lock fa-sm"></i></button>';
            }else{
                return '<div class="text-nowrap">'.
                        '<button onclick="openDetilLPJ(this, \'/'.$t->id.'\', \'#detil\')" class="btn btn-sm btn-outline-info border-0" title="info"><i class="fas fa-list fa-sm"></i></button>&nbsp'.
                        '<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="info"><i class="fas fa-trash fa-sm"></i></button>'.
                        '</div>';
            }
        })->addColumn('tipe_raw', function ($t) { 
            return $t->tipe;
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
        $lpj = LPJ::where('id',$idlpj)->select('id','tanggal','tipe')->first();
        $data=BKU::where('isactive',1)
            ->whereMonth('tanggalref',$lpj->tanggal->month)
            ->whereYear('tanggalref',$lpj->tanggal->year)
            ->where('tipe',$lpj->tipe)
            ->where('idsubkegiatan',$lpj->idsubkegiatan)
            ->select('nomor','tanggalref','idtransaksi','idrekening','uraian','nominal')
            ->with(['transaksi:id,kodetransaksi,isspj', 'rekening:id,kode,nama']);
        $datatable = Datatables::of($data);
        return $datatable->make(true);
    }

    public function getBKUByPeriod($idsubkegiatan, $tipe, $month, $year){
        $data=BKU::where('isactive',1)
            ->whereMonth('tanggalref',$month)
            ->whereYear('tanggalref',$year)
            ->where('tipe',$tipe)
            ->where('idsubkegiatan',$idsubkegiatan)
            ->select('nomor','tanggalref','idtransaksi','idrekening','uraian','nominal')
            ->with(['transaksi:id,kodetransaksi,isspj', 'rekening:id,kode,nama']);
        $datatable = Datatables::of($data);
        return $datatable->make(true);
    }

    public function storeUpdateLPJ(Request $request){
        $user = Auth::user();
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:lpj,id',
            'tanggal' => 'required_without:id|string',
            'idsubkegiatan' => 'required_without:id|integer',
            'tipe' => 'required_without:id|string|in:UP,LS,TU,GU',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        //jika edit lpj old
        if (isset($input['id'])) {
            $lpj=LPJ::find($input['id']);
            if($lpj == NULL){ return back()->with('error','LPJ tidak ditemukan.');}
            $lpj->fill([
                'idm' => $user->id,
            ]);
            $lpj->fill($input);
            $date=$lpj->tanggal;
        }
        else{ //jika create lpj baru
            $date=Carbon::parse($input['tanggal']);
            $exist=LPJ::where('idsubkegiatan', $input['idsubkegiatan'])
                ->where('isactive',1)
                ->whereMonth('tanggal',$date->month)
                ->whereYear('tanggal',$date->year)
                ->where('tipe', $input['tipe'])->first();
            if($exist) { return back()->with('error','LPJ periode tsb sudah ada.');}
            $lpj = new LPJ();
            $lpj->fill([
                'idm' => $user->id,
                'idc' => $user->id,
            ]);
            $lpj->fill($input);

            //set nomor pada LPJ
            $latest=LPJ::select('id','nomor')
                ->where('isactive',1)
                ->where('nomor','<>',NULL)
                ->whereYear('tanggal',$date->year)
                ->orderBy('id', 'DESC')
                ->where('tipe', $input['tipe'])
                ->where('idsubkegiatan',  $input['idsubkegiatan'])->first();
            if(isset($latest)){
                $nomor=intval($latest->nomor)+1;
            }else{
                $nomor=1;
            }
            $lpj->fill([
                'nomor' =>substr(str_repeat(0, 5).strval($nomor), - 5),   //convert agar nomor ada leading zero
            ]);
        }
        // fill total nominal
        $total=BKU::where('isactive',1)
            ->whereMonth('tanggalref',$date->month)
            ->whereYear('tanggalref',$date->year)
            ->where('tipe',$lpj->tipe)
            ->where('idsubkegiatan',$lpj->idsubkegiatan)
            ->select('nomor','tanggalref','idtransaksi','idrekening','uraian','nominal')
            ->sum('nominal');
        $lpj->fill(['total'=>$total]);
        $lpj->save();

        return back()->with('success','Berhasil menyimpan');
    }

    public function deleteLPJ(Request $request){
        $user = Auth::user();
        $userId = $user->id;
        try {
            DB::beginTransaction();
            $model=LPJ::where('id',$request->input('id'))->with(['subkegiatan:id,idunitkerja,nama'])->first();
            if($user->idunitkerja !== $model->subkegiatan->idunitkerja ){
                throw new \Exception("restricted");
            }
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();

            DB::commit();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Gagal menghapus');
        }
    }

    public function getLPJ(Request $request){
        if(isset($request->upls)==False) return abort(404);
        $user = Auth::user();
        $upls = explode(',',$request->upls);
        $idunitkerja = $user->idunitkerja;
        $date=Carbon::now();
        $data = LPJ::select('id','nomor','tanggal','total','transaksiterikat')
            ->where('isactive',1)
            ->whereYear('tanggal',$date->year)
            ->whereIn('tipe',$upls)
            ->with(['subkegiatan'=>function($q) use($idunitkerja) {
                $q->where('idunitkerja', $idunitkerja);
            }]);
        
        if(isset($request->nomor)){
            $nomor = $request->nomor=='NULL'? null : $request->nomor;
            $data->where('nomor',$nomor);     //nomor
        }
        else{
            $data->where('nomor','<>',NULL);
        }

        if(isset($request->transaksiterikat)){
            if($request->transaksiterikat=='NULL'){
                $data->where('transaksiterikat',null);      //ambil LPJ yg BELUM terikat SPP sama sekali
            }else{
                $transaksiterikat = $request->transaksiterikat;         //ambil LPJ yg terikat dengan SPP tertentu dan yg belum terikat SPP sama sekali
                $data->where(function($q) use($transaksiterikat){
                    $q->where('transaksiterikat',null)
                        ->orWhere('transaksiterikat',$transaksiterikat);
                });     
            }
        }

        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }
}
