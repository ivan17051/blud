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
use PDF;
use Validator;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $user = Auth::user();
        $subkegiatan=SubKegiatan::where('isactive', 1)->select('idgrup','idkegiatan','kode','nama')->get();
        $rekening=Rekening::where('isactive', 1)->select('id','kode','nama')->get();
        $rekanan=Rekanan::where('isactive', 1)->select('id','nama')->get();
        $pejabat=Pejabat::where('isactive', 1)->select('id','idunitkerja','nama','nip')->where('idunitkerja',$user->idunitkerja)->get();
        return view('transaksi',['subkegiatan'=>$subkegiatan, 'rekening'=>$rekening, 'rekanan'=>$rekanan, 'user'=>$user, 'pejabat'=>$pejabat]);
    }

    public function data(Request $request){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = Transaksi::where('isactive',1)->with(['unitkerja','rekening','subkegiatan']);
        }else{
            $data = Transaksi::where('isactive',1)->with(['unitkerja','rekening','subkegiatan'])
                    ->where('idunitkerja',$user->idunitkerja);
        }
        
        $datatable = Datatables::of($data);
        $datatable->editColumn('tanggalref', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->addIndexColumn()
            ->editColumn('tipe', function ($t) { 
                return $t->tipe==='TU'?
                    "<span class=\"badge bg-success text-white\">TU</span>":
                    "<span class=\"badge bg-primary text-white\">LS</span>";
            })
            ->editColumn('jenis', function ($t) { 
                return $t->jenis===1?"<p class=\"text-success\"><b><i class=\"fas fa-arrow-up fa-sm\"></i>&nbspdebit</b></p>":"<p class=\"text-danger\"><b><i class=\"fas fa-arrow-down fa-sm\"></i>&nbspkredit</b></p>";
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
            ->rawColumns(['tipe','jenis','status','action','ppd','sopd','spd']);
        if(in_array($user->role,['KEU'])){
            $datatable
                ->addColumn('action', function ($t) use($user){ 
                    $html='';
                    if ($t->status===0) {
                        $html.='<button onclick="tolak(this)" class="btn btn-sm btn-outline-danger border-0" title="tolak"><i class="fas fa-eraser fa-sm"></i></button>&nbsp';
                    }
                    $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                    return $html;
                })
                ->addColumn('ppd',function($t){
                    $cnt=count($t->riwayat);
                    if($t->status===-1){
                        //status ppd ditolak
                        return '<button disabled class="btn btn-sm btn-outline-danger border-0" title="ditolak"><i class="fas fa-times fa-sm"></i></button>';
                    }
                    else if($cnt===0){
                        //aksi menyetujui ppd
                        return '<button onclick="acc(this)" class="d-inline-block btn btn-sm btn-outline-info border-0" title="acc">Acc&nbsp<i class="fas fa-paper-plane fa-sm"></i></button>';
                    }
                    else{
                        //status ppd di-ACC
                        return '<button disabled class="btn btn-sm btn-outline-success border-0" title="acc"><i class="fas fa-check fa-sm"></i></button>';
                    }
                })
                ->addColumn('sopd',function($t){
                    $cnt=count($t->riwayat);
                    if($cnt===1){
                        //aksi menyetujui sopd
                        return '<button onclick="acc(this)" class="d-inline-block btn btn-sm btn-outline-info border-0" title="acc">Acc&nbsp<i class="fas fa-paper-plane fa-sm"></i></button>';
                    }
                    else if($cnt<1){
                        //status sopd digembok
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="terkunci"><i class="fas fa-lock fa-sm"></i></button>';
                    }
                    else{
                        //status sopd di-ACC
                        return '<button disabled class="btn btn-sm btn-outline-success border-0" title="acc"><i class="fas fa-check fa-sm"></i></button>';
                    }
                })
                ->addColumn('spd',function($t){
                    $cnt=count($t->riwayat);
                    if($cnt===2){
                        //aksi menyetujui spd
                        return '<button onclick="acc(this)" class="d-inline-block btn btn-sm btn-outline-info border-0" title="acc">Acc&nbsp<i class="fas fa-paper-plane fa-sm"></i></button>';
                    }
                    else if($cnt<2){
                        //status spd digembok
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="terkunci"><i class="fas fa-lock fa-sm"></i></button>';
                    }
                    else{
                        //status spd di-ACC
                        return '<button disabled class="btn btn-sm btn-outline-success border-0" title="acc"><i class="fas fa-check fa-sm"></i></button>';
                    }
                });
        }else{
            $datatable
                ->addColumn('action', function ($t) use($user){ 
                    $html='';
                    if ($t->status===0 AND $user->role==='PKM') {
                        $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>&nbsp';
                    }
                    $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                    return $html;
                });
        }
        return $datatable->make(true);  
    }

    public function storeUpdateTransaksi(Request $request){
        $user = Auth::user();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            'tipe' => 'required|string|in:LS,TU',
            'jenis' => 'required|in:0,1',
            'tanggalref' => 'required|string',
            'idgrup' => 'integer',
            'idrekening' => 'required|exists:mrekening,id',
            'idrekanan' => 'required|exists:mrekanan,id',
            'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'keterangan' => 'required|string|max:255',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        $input['idunitkerja']=$user->idunitkerja;

        //jika edit transaksi old [NOT USED YET]
        if(isset($input['id'])){
            $t=Transaksi::find($input['id']);
            $t->fill($input);
            $t->fill([
                'riwayat'=>array(),
                'status'=>1,
                'idm'=>$user->id,
            ]);
        }
        else{
            //get saldo teraktual
            $saldo=Saldo::where('idgrup',$input['idgrup'])
                ->where('idunitkerja',$input['idunitkerja'])
                ->orderBy('tanggal', 'DESC')
                ->orderBy('id', 'DESC')
                ->first();

            if(isset($saldo)===FALSE){  //belum ada saldo sama sekali
                return back()->with('error','Sub-Kegiatan belum memiliki saldo');
            }
            elseif($saldo->saldo-floatval($input['jumlah']) < 0){   //cek kecukupan saldo
                return back()->with('error','Saldo tidak mencukupi');
            }

            $t=new Transaksi();
            $t->fill($input);
            $t->fill([
                'saldo'=>999999,
                'riwayat'=>array(),
                'status'=>0,
                'tanggal'=>Carbon::now()->format('Y-m-d'),
                'idc'=>$user->id,
                'idm'=>$user->id,
            ]);
        }

        //cek apakah ada proses edit atau tidak
        if($t->isDirty()){
            $t->save();
            return back()->with('success','Berhasil menyimpan');
        }else{
            return back()->with('error','Tidak ada perubahan');
        }
    }

    public function deleteTransaksi(Request $request){
        $userId = Auth::id();
        try {
            $model=Transaksi::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function tolakTransaksi(Request $request){
        $userId = Auth::id();
        try {
            $model=Transaksi::find($request->input('id'));
            $model->fill([
                'pesanpenolakan'=>$request->input('pesanpenolakan'),
            ]);
            $model->idm=$userId;
            $model->status=-1;
            $model->save();
            return back()->with('success','Berhasil menolak');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menolak');
        }
    }

    public function accTransaksi(Request $request){
        $userId = Auth::id();
        try {
            DB::beginTransaction();
            $tgl=Carbon::now()->format('Y-m-d');
            $model=Transaksi::find($request->input('id'));
            $oldstatus=$request->input('oldstatus');

            if( intval($oldstatus)!==intval($model->status) ){
                //mencegah refresh berkali-kali
                return back();
            }
            $riwayat = $model->riwayat;
            $model->idm=$userId;
            switch ($model->status) {
                case 0:
                    //acc PPD
                    $model->status=1;
                    array_push($riwayat,[$tgl,$userId]);
                    $model->riwayat=$riwayat;
                    break;
                case 1:
                    //acc SOPD
                    $model->status=2;
                    array_push($riwayat,[$tgl,$userId]);
                    $model->riwayat=$riwayat;
                    break;
                case 2:
                    //acc SPD
                    $model->status=3;
                    array_push($riwayat,[$tgl,$userId]);
                    $model->riwayat=$riwayat;
                    break;
            }

            if($model->isClean()){
                throw new \Exception('Tidak ada perubahan');
            }

            //Persetujjuan pertama kali akan melakukan pengurangan saldo
            if($model->status === 1){
                $tgl=Carbon::createFromDate($model->tanggalref);
                $tgl->day = 1;
                $saldos=Saldo::where('idgrup',$model->idgrup)
                    ->where('idunitkerja',$model->idunitkerja)
                    ->whereDate('tanggal','>=',$tgl->format('Y-m-d'))
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->get();
            
                if($saldos->isEmpty() OR in_array($saldos[0]->tipe, ['inisial','revisi']) ){
                    //get saldo teraktual
                    $s=Saldo::where('idgrup',$model->idgrup)
                        ->where('idunitkerja',$model->idunitkerja)
                        ->orderBy('tanggal', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->first();
                    
                    //cek kecukupan saldo
                    $newjumlah=$s->saldo-floatval($model->jumlah);
                    if($newjumlah < 0){  
                        throw new \Exception('Saldo tidak mencukupi');
                    }

                    // jika kosong atau belum saldo tipe NON-inisial atau NON-revisi
                    $newsaldo=new Saldo();
                    $newsaldo->fill([
                        'idunitkerja'=>$model->idunitkerja,
                        'idgrup'=>$model->idgrup,
                        'saldo'=>$newjumlah,
                        'tanggal'=>$tgl,
                        'idm'=>$userId,
                        'idc'=>$userId
                    ]);
                    $newsaldo->save();
                }else{
                    //update saldo-saldo tanggal tsb hingga saat ini
                    foreach ($saldos as $s) {

                        //cek kecukupan saldo
                        $newjumlah=$s->saldo-floatval($model->jumlah);
                        if($newjumlah < 0){  
                            throw new \Exception('Saldo tidak mencukupi');
                        }

                        $s->fill([
                            'saldo' => $newjumlah,
                            'idm' => $userId
                        ]);
                        $s->save();
                    }
                }

            }

            $model->save();
            DB::commit();
            return back()->with('success','Berhasil menyetujui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }
        
    public function sptb(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan','rekening'])->find($id);
        return view('reportSptb', ['transaksi' => $transaksi]);
    }
    public function spp(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan','rekening'])->find($id);
        return view('reportSpp', ['transaksi' => $transaksi]);
    }
    public function spm(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan','rekening'])->find($id);
        return view('reportSpm', ['transaksi' => $transaksi]);
    }
}
