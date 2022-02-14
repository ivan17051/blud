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
            $data = Transaksi::where('transaksi.isactive',1)->where('isspj',1)
                ->with(['unitkerja','subkegiatan']);
                // status lebih dari 1 artinya sudah masuk pengajuan sp2d
            // dd($data);
        }else{
            $data = Transaksi::where('isactive',1)->where('isspj',1)->where('idunitkerja',$user->idunitkerja)
                ->select('id','idunitkerja','kodetransaksi','kodepekerjaan','tanggal','keterangan','isactive','idkepada','rekening','tipe');
        }
        
        $datatable = Datatables::of($data);
        $datatable->editColumn('tanggal', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->addColumn('tanggal_raw', function ($t) { 
                return $t->tanggal;
            })
            ->addIndexColumn()
            ->editColumn('unitkerja', function ($t){
                return $t->unitkerja->nama_alias;
            })
            ->editColumn('kodetransaksi', function ($t){
                return $t->kodetransaksi;
            })
            ->editColumn('kodepekerjaan', function ($t) { 
                return $t->kodepekerjaan;
            })
            ->editColumn('keterangan', function ($t) { 
                return $t->keterangan;
            })
            ->editColumn('idrekanan', function ($t) { 
                return $t->idkepada;
            })
            ->editColumn('rekening', function ($t) { 
                return $t->rekening;
            })
            ->editColumn('tipe', function ($t) { 
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
            })
            ->addColumn('tipe_raw', function ($t) { 
                return $t->tipe;
            })
            ->rawColumns(['tanggal','kodetransaksi','kodepekerjaan','keterangan','action','tipe']);
        if(in_array($user->role,['PKM'])){
            $datatable
                ->addColumn('action', function ($t) use($user){ 
                    $html='';
                    if ($t->parent == NULL) {
                        $html.='<button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Transaksi" data-toggle="modal" data-target="#sunting"><i class="fas fa-edit fa-sm"></i></button>';
                        $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" style="width:2rem;" title="Hapus Transaksi"><i class="fas fa-trash fa-sm"></i></button>';
                    }
                    $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" style="width:2rem;" title="Info"><i class="fas fa-ellipsis-v fa-sm"></i></button>';
                    return $html;
                });
        }
        else{
            $datatable
                ->addColumn('action', function ($t) { 
                    return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="Info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                });
        }
        return $datatable->make(true);  
    }

    public function storeUpdateLPJ(Request $request){
        $user = Auth::user();
        // $input = array_map('trim', $request->all());
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            // 'tipe' => 'required_without:id|string|in:UP,LS,TU',
            // 'jenis' => 'required|in:0,1',
            'tanggalref' => 'required_without:id|string',
            'rekening' => 'nullable',                 //--REKENING
            'jumlah' => 'nullable|array',
            'pajak' => 'nullable|array',                    //--PAJAK
            'nominalpajak' => 'nullable|array',
            'kodebilling' => 'nullable|array',
            'tanggalkadaluarsa' => 'nullable|array',
            'kodepotongan' => 'nullable|array',             //--POTONGAN
            'potongan' => 'nullable|array',
            'nominalpotongan' => 'nullable|array',
            'idrekanan' => 'required_without:id|integer',
            'flagkepada' => 'nullable|integer',
            // 'tipepembukuan' => 'nullable|string|in:pindahbuku,tunai',
            'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'keterangan' => 'required_without:id|string|max:255',
        ]);
        if ($validator->fails()) return back()->with('error',$validator->messages());
        
        $input = $validator->valid();
        $input['idunitkerja']=$user->idunitkerja;
        if(isset($input['idrekanan'])){
            $input['idkepada']=$input['idrekanan'];
        }
        if(isset($input['idrekanan'])){
            $input['flagkepada']=2;
        }
        
        //membuat array rekening untuk db dng urutan [id, kode, nama rekening, jumlah]
        $newRekeningArray=[];
        if(isset($input['rekening']) ){
            $rekening=Rekening::where('id', $input['rekening'])->select('id','kode','nama')->first()->toArray();

            $rekening=array_values($rekening);
            array_push($rekening,floatval($input['jumlah']));
            array_push($newRekeningArray,$rekening);
                
            $input['rekening']=$newRekeningArray;
            
        }
        
        //membuat array pajak untuk db dng urutan [id, kode, nama pajak, nominal, kodebilling, tanggal kadaluarsa]
        $newPajakArray=[];

        //membuat array potongan untuk db dng urutan [kode, nama potongan, nominal ]
        $newPotonganArray=[];

        //jika edit transaksi old
        if(isset($input['id'])){
            $t=Transaksi::find($input['id']);
            if($t->status===3){
                return back()->with('error','SP2D sudah disetujui.');
            }

            $t->fill($input);
            $t->fill([
                'idm'=>$user->id,
            ]);
        }
        else{ //jika create transaksi baru            
            $input['rekening']=$newRekeningArray;
            
            //cari transaksi teraktual di tahun ini untuk ambil nomor
            $year=Carbon::createFromFormat('Y-m-d', $input['tanggalref'])->year;
        
            $subkegiatan = SubKegiatan::where('idunitkerja',$input['idunitkerja'])->where('isactive',1)->select('id')->first();
            
            $t=new Transaksi();
            $t->fill($input);
            $t->fill([
                'riwayat'=>array(),
                'status'=>0,
                'tanggal'=>Carbon::now()->format('Y-m-d'),
                'idc'=>$user->id,
                'idm'=>$user->id,
                'saldo'=> 0,
                'isspj'=>1,
                'idsubkegiatan'=>$subkegiatan->id,
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

    public function deleteLPJ(Request $request){
        $user = Auth::user();
        $userId = $user->id;
        try {
            $model=Transaksi::find($request->input('id'));
            if($user->idunitkerja !== $model->idunitkerja
                OR $model->status===3){
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
}
