<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use App\Pejabat;
use App\UnitKerja;
use App\Transaksi;
use App\Rekanan;
use App\Saldo;

class SPJController extends Controller
{
    public function spj(){
        $user = Auth::user();
        $unitKerja=UnitKerja::where('id',$user->idunitkerja)->select('id','nama','nama_alias')->get();
        $rekanan=Rekanan::where('isactive', 1)->select('id', 'nama')->get();
        if(in_array($user->role,['admin','PIH'])){
            $spj = Transaksi::where('isspj', 1)->where('isactive', 1)->get();
        }else{
            $spj = Transaksi::where('isspj', 1)->where('isactive', 1)->where('idunitkerja',$user->idunitkerja)->get();
        }        
        
        return view('spj', ['user' =>$user, 'unitkerja'=>$unitKerja, 'spj'=>$spj, 'rekanan'=>$rekanan]);
    }

    public function data(Request $request){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = Transaksi::where('transaksi.isactive',1)
                ->where('status','>',1)->with(['unitkerja','subkegiatan']);
                // status lebih dari 1 artinya sudah masuk pengajuan sp2d
        }else{
            $data = Transaksi::where('isactive',1)->where('isspj',1)
                ->where('idunitkerja',$user->idunitkerja);
        }
        $datatable = Datatables::of($data);
        // $datatable->editColumn('tanggalref', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
        //     ->addIndexColumn()
        //     ->editColumn('jenis', function ($t) { 
        //         return $t->jenis===1?"<p class=\"text-success\"><b><i class=\"fas fa-arrow-up fa-sm\"></i>&nbspdebit</b></p>":"<p class=\"text-danger\"><b><i class=\"fas fa-arrow-down fa-sm\"></i>&nbspkredit</b></p>";
        //     })
        //     ->addColumn('status_raw', function ($t) {
        //         return $t->status;
        //     })
        //     ->editColumn('jumlah', function ($t){
        //         return number_format($t->jumlah,0,',','.');
        //     })
        //     ->editColumn('status', function ($t) { 
        //         switch ($t->status) {
        //             case 0:
        //                 return '<button class="btn btn-sm btn-outline-dark border-0" title="acc"><i class="fas fa-hourglass-half fa-sm"></i>&nbsp belum</button>';
        //                 break;
        //             case 1:
        //                 return '<button class="btn btn-sm btn-warning border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp ppd</button>';
        //                 break;
        //             case 2:
        //                 return '<button class="btn btn-sm btn-info border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp sopd</button>';
        //                 break;
        //             case 2:
        //                 return '<button class="btn btn-sm btn-success border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp spd</button>';
        //                 break;
        //             default:
        //                 return '';
        //         }
        //     })
        //     ->rawColumns(['tipe','jenis','status','action','sptb','spp','spm','sp2d']);
        // if(in_array($user->role,['PKM'])){
        //     $datatable
        //         ->addColumn('action', function ($t) use($user){ 
        //             $html='';
        //             if ($t->status<2 || $t->status==4) {
        //                 $html.='<button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Transaksi" data-toggle="modal" data-target="#sunting"><i class="fas fa-edit fa-sm"></i></button>';
        //                 $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" style="width:2rem;" title="Hapus Transaksi"><i class="fas fa-trash fa-sm"></i></button>';
        //             }
        //             $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" style="width:2rem;" title="Info"><i class="fas fa-ellipsis-v fa-sm"></i></button>';
        //             return $html;
        //         })
        //         ->addColumn('spp',function($t){
        //             return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spp\',\''.$t->id.'\')" title="Cetak SPP">Cetak</button>';
        
        //         })
        //         ->addColumn('spm',function($t){
        //             if($t->status<1){
        //                 //tombol membuat spm
        //                 return '<button class="btn btn-sm btn-warning " onclick="buatSpm(this)">Buat</button>';
        //             }
        //             else{
        //                 return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spm\',\''.$t->id.'\')" title="Cetak SPM">Cetak</button>';
        //             }
        //         })
        //         ->addColumn('sp2d',function($t){
        //             if($t->status===3){
        //                 //sp2d telah di-acc
        //                 return '<button disabled class="btn btn-sm btn-success d-block mb-2 text-nowrap"><i class="fas fa-lock fa-sm"></i> Diterima</button>'.
        //                     '<button class="btn btn-sm btn-primary " onclick="cetak(\'sp2d\',\''.$t->id.'\',\''.$t->tipepembukuan.'\')" title="Cetak SP2D">Cetak</button>';
        //             }
        //             else if($t->status===2){
        //                 //menunggu di-acc
        //                 return '<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="batal(this)"><i class="fas fa-ban fa-sm"></i> Batal</a>';
        //             }
        //             else if($t->status===1 or $t->status===4){  //4 artinya revisi
        //                 //boleh mengajukan
        //                 $html='';
        //                 if($t->status===4){  
        //                     $html.='<button disabled class="btn btn-sm btn-danger btn-outline-default mb-2 border-0" title="revisi"><i class="fas fa-times fa-sm"></i> Ditolak</button>';
        //                 }
        //                 return $html.'<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="acc(this)" title="Forward"><i class="fas fa-paper-plane fa-sm"></i> Fwd</a>';
        //             }
        //             else{
        //                 return '<button disabled class="btn btn-sm btn-outline-default border-0" title="Terkunci"><i class="fas fa-lock fa-sm"></i></button>';
        //             }
        //         });
        // }
        // else{
        //     $datatable
        //         ->addColumn('action', function ($t) { 
        //             return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="Info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
        //         });
        // }
        return $datatable->make(true);  
    }

    public function storeUpdateSPJ(Request $request){
        $user = Auth::user();
        // $input = array_map('trim', $request->all());
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            // 'tipe' => 'required_without:id|string|in:UP,LS,TU',
            // 'jenis' => 'required|in:0,1',
            'tanggalref' => 'required_without:id|string',
            'rekening' => 'nullable|array',                 //--REKENING
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
            // 'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
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
        $newJumlah=0;
        if(isset($input['rekening']) ){
            foreach ($input['rekening'] as $i=>$idrekening) {
                $rekening=Rekening::where('id',$idrekening)->select('id','kode','nama')->first()->toArray();
                $newJumlah+=floatval($input['jumlah'][$i]);
                $rekening=array_values($rekening);
                array_push($rekening,floatval($input['jumlah'][$i]));
                array_push($newRekeningArray,$rekening);
            }
            $input['rekening']=$newRekeningArray;
            $input['jumlah']=$newJumlah;
        }

        //membuat array pajak untuk db dng urutan [id, kode, nama pajak, nominal, kodebilling, tanggal kadaluarsa]
        $newPajakArray=[];
        if(isset($input['pajak']) ){
            foreach ($input['pajak'] as $i=>$id) {
                $pajak=Pajak::where('id',$id)->select('id','kode','nama')->first()->toArray();
                $pajak=array_values($pajak);
                $pajak=array_merge($pajak, [
                    floatval($input['nominalpajak'][$i]),
                    $input['kodebilling'][$i],
                    $input['tanggalkadaluarsa'][$i],
                ]);
                array_push($newPajakArray,$pajak);
            }
        }

        //membuat array potongan untuk db dng urutan [kode, nama potongan, nominal ]
        $newPotonganArray=[];
        if(isset($input['potongan']) ){
            foreach ($input['potongan'] as $i=>$id) {
                array_push($newPotonganArray,[
                    $input['kodepotongan'][$i],
                    $input['potongan'][$i],
                    $input['nominalpotongan'][$i]
                ]);
            }
        }

        //jika edit transaksi old
        if(isset($input['id'])){
            $t=Transaksi::find($input['id']);
            if($t->status===3){
                return back()->with('error','SP2D sudah disetujui.');
            }

            //update info saldo pada row transaksi
            if(isset($input['rekening'])){
                //get saldo teraktual
                $saldo=Saldo::where('idgrup',$t->idgrup)
                    ->where('idunitkerja',$t->idunitkerja)
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->first();

                if(isset($saldo)===FALSE){  //belum ada saldo sama sekali
                    return back()->with('error','Sub-Kegiatan belum memiliki saldo');
                }
                elseif($saldo->saldo-floatval($input['jumlah']) < 0){   //cek kecukupan saldo
                    return back()->with('error','Saldo tidak mencukupi');
                }

                $saldotemporary=$saldo->saldo-floatval($input['jumlah']);
                $t->saldo=$saldotemporary;
            }

            //update info pajak pada row transaksi
            if(isset($input['pajak'])){
                $input['pajak']=$newPajakArray;
            }

            //update info potongan pada row transaksi
            if(isset($input['potongan'])){
                $input['potongan']=$newPotonganArray;
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
        
            $transaksi_aktual=Transaksi::select('id','nomor')
                ->where('isactive',1)
                ->whereYear('tanggalref',$year)
                ->orderBy('id', 'DESC')
                ->where('idunitkerja',$input['idunitkerja'])->first();
            if(isset($transaksi_aktual)){
                $nomor=intval($transaksi_aktual->nomor)+1;
            }else{
                $nomor=1;
            }
            //convert agar nomor ada leading zero
            $nomor = substr(str_repeat(0, 5).strval($nomor), - 5);
            
            $t=new Transaksi();
            $t->fill($input);
            $t->fill([
                'riwayat'=>array(),
                'status'=>0,
                'tanggal'=>Carbon::now()->format('Y-m-d'),
                'idc'=>$user->id,
                'idm'=>$user->id,
                'nomor'=>$nomor,
                'saldo'=> 0
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
}
