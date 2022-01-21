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
        $pejabat=Pejabat::where('isactive', 1)->select('id','idunitkerja','nama','nip','jabatan','rekening')->where('idunitkerja',$user->idunitkerja)->get();
        return view('transaksi',['subkegiatan'=>$subkegiatan, 'rekening'=>$rekening, 'rekanan'=>$rekanan, 'user'=>$user, 'pejabat'=>$pejabat]);
    }

    public function data(Request $request){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = Transaksi::where('isactive',1)
                ->where('status','>',1)->with(['unitkerja','subkegiatan']);
                // status lebih dari 1 artinya sudah masuk pengajuan sp2d
        }else{
            $data = Transaksi::where('isactive',1)->with(['unitkerja','subkegiatan'])
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
            ->rawColumns(['tipe','jenis','status','action','sptb','spp','spm','sp2d']);
        if(in_array($user->role,['KEU'])){
            $datatable
                ->addColumn('action', function ($t) { 
                    return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                })
                ->addColumn('sptb',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'sptb\',\''.$t->id.'\')">Cetak</button>';
                })
                ->addColumn('spp',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spp\',\''.$t->id.'\')">Cetak</button>';
        
                })
                ->addColumn('spm',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spm\',\''.$t->id.'\')">Cetak</button>';
                })
                ->addColumn('sp2d',function($t){
                    if($t->status===3){
                        //sp2d telah di-acc
                        return '<button class="btn btn-sm btn-primary " onclick="cetak(\'sp2d\',\''.$t->id.'\')">Cetak</button>';
                    }
                    else if($t->status===2){
                        //Tombol acc untuk sp2d
                        return '<a href="javascript:void(0);" class="btn btn-sm btn-danger " onclick="tolak(this)"><i class="fas fa-times fa-sm"></i>Revisi</a>'.
                            '<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="acc(this)"><i class="fas fa-check fa-sm"></i>Terima</a>';
                    }
                    else if($t->status===4){  
                        //4 artinya revisi
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="revisi">revisi</button>';
                    }
                    else{
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="terkunci"><i class="fas fa-lock fa-sm"></i></button>';
                    }
                });
        }
        else if(in_array($user->role,['PKM'])){
            $datatable
                ->addColumn('action', function ($t) use($user){ 
                    $html='';
                    if ($t->status<3) {
                        $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>&nbsp';
                    }
                    $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                    return $html;
                })
                ->addColumn('sptb',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'sptb\',\''.$t->id.'\')">Cetak</button>';
        
                })
                ->addColumn('spp',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spp\',\''.$t->id.'\')">Cetak</button>';
        
                })
                ->addColumn('spm',function($t){
                    if($t->status<1){
                        //tombol membuat spm
                        return '<button class="btn btn-sm btn-warning " onclick="buatSpm(this)">Buat</button>';
                    }
                    else{
                        return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spm\',\''.$t->id.'\')">Cetak</button>';
                    }
                })
                ->addColumn('sp2d',function($t){
                    if($t->status===3){
                        //sp2d telah di-acc
                        return '<button class="btn btn-sm btn-primary " onclick="cetak(\'sp2d\',\''.$t->id.'\')">Cetak</button>';
                    }
                    else if($t->status===2){
                        //menunggu di-acc
                        return '<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="batal(this)"><i class="fas fa-ban fa-sm"></i>Batal</a>';
                    }
                    else if($t->status===1 or $t->status===4){  //4 artinya revisi
                        //boleh mengajukan
                        $html='';
                        if($t->status===4){  
                            $html.='<button disabled class="btn btn-sm btn-outline-default border-0" title="revisi">revisi</button>';
                        }
                        return $html.'<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="acc(this)"><i class="fas fa-paper-plane fa-sm"></i>Ajukan</a>';
                    }
                    else{
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="terkunci"><i class="fas fa-lock fa-sm"></i></button>';
                    }
                });
        }
        else{
            $datatable
                ->addColumn('action', function ($t) { 
                    return '<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                });
        }
        return $datatable->make(true);  
    }

    public function storeUpdateTransaksi(Request $request){
        $user = Auth::user();
        // $input = array_map('trim', $request->all());
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            'tipe' => 'required_without:id|string|in:UP,LS,TU',
            // 'jenis' => 'required|in:0,1',
            'tanggalref' => 'required_without:id|string',
            'idgrup' => 'required_without:id|integer',
            'rekening' => 'nullable|array',
            'jumlah' => 'nullable|array',
            'idrekanan' => 'required_without:id|integer',
            'dibayarkan' => 'required_without:id|integer',
            // 'tipepembukuan' => 'nullable|string|in:pindahbuku,tunai',
            // 'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'keterangan' => 'required_without:id|string|max:255',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        $input['idunitkerja']=$user->idunitkerja;
        $input['idkepada']=$input['idrekanan'];
        $input['flagkepada']=$input['dibayarkan'];

        //membuat array rekening untuk db dng urutan [id, kode, nama rekening, jumlah]
        $newRekeningArray=[];
        $newJumlah=0;
        if(isset($input['rekening']) AND isset($input['jumlah'])){
            foreach ($input['rekening'] as $i=>$idrekening) {
                $rekening=Rekening::where('id',$idrekening)->select('id','kode','nama')->first()->toArray();
                $newJumlah+=floatval($input['jumlah'][$i]);
                $rekening=array_values($rekening);
                array_push($rekening,floatval($input['jumlah'][$i]));
                array_push($newRekeningArray,$rekening);
            }
        }
        $input['rekening']=$newRekeningArray;
        $input['jumlah']=$newJumlah;

        //jika edit transaksi old [NOT USED YET]
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

            //cari transaksi teraktual di tahun ini untuk ambil nomor
            $year=Carbon::createFromFormat('d/m/Y', $input['tanggalref'])->year;
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
                'nomor'=>$nomor
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

    /**
     * dimaksudkan untuk permintaan revisi transaksi
     */
    public function tolakTransaksi(Request $request){
        $userId = Auth::id();
        try {
            $model=Transaksi::find($request->input('id'));
            $model->fill([
                'pesanpenolakan'=>$request->input('pesanpenolakan'),
            ]);
            $model->idm=$userId;
            $model->status=4;
            $model->save();
            return back()->with('success','Berhasil menolak');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menolak');
        }
    }

    /**
     * dimaksudkan untuk permintaan revisi transaksi
     */
    public function batalkanPengajuanSP2D(Request $request){
        $user = Auth::user();
        $userId = $user->id;
        try {
            $model=Transaksi::find($request->input('id'));
            if($user->idunitkerja !== $model->idunitkerja
                OR $model->status!==2){
                throw new \Exception("");
            }
            $model->idm=$userId;
            $model->status=1;
            $model->save();
            return back()->with('success','Berhasil membatalkan');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal membatalkan');
        }
    }

    public function accTransaksi(Request $request){
        $user=Auth::user();
        $userId = $user->id;
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
                    //buat spm
                    $model->status=1;

                    if(count($model->rekening)===0){  
                        throw new \Exception('Belum ada rekening.');
                    }

                    array_push($riwayat,[$tgl,$userId],"Membuat SPM");
                    $model->riwayat=$riwayat;
                    $model->tipepembukuan=$request->input('tipepembukuan');
                    break;
                case 1:
                    //pengajuan sp2d
                    $model->status=2;
                    array_push($riwayat,[$tgl,$userId],"Pengajuan SP2D");
                    $model->riwayat=$riwayat;
                    break;
                case 2:
                    //acc sp2d
                    $model->status=3;
                    array_push($riwayat,[$tgl,$userId],"SP2D disetujui");
                    $model->riwayat=$riwayat;
                    break;
                case 4:
                    if($user->role==='PKM'){
                        //setelah merevisi, mengajukan sp2d kembali
                        $model->status=2;
                        array_push($riwayat,[$tgl,$userId],"Pengajuan SP2D (revisi)");
                        $model->riwayat=$riwayat;
                    }elseif($user->role==='KEU'){
                        //acc sp2d tapi dari hasil revisi
                        $model->status=3;
                        array_push($riwayat,[$tgl,$userId],"Permintaan Revisi");
                        $model->riwayat=$riwayat;
                    }
                    break;
            }

            if($model->isClean()){
                throw new \Exception('Tidak ada perubahan');
            }

            //setelah ada persetujuan sp2d dari keuangan
            if($model->status === 3){
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
        $otorisator = Pejabat::select('id', 'nama', 'nip', 'jabatan')->findOrFail($request->idotorisator);
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        return view('report.sptb', ['transaksi' => $transaksi, 'otorisator' => $otorisator]);
    }
    public function spp(Request $request, $id){
        $otorisator = Pejabat::select('id', 'nama', 'nip', 'jabatan')->findOrFail($request->idotorisator);
        $bendahara = Pejabat::findOrFail($request->idbendahara);
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $saldo = Saldo::where('idgrup',$transaksi->idgrup)
            ->where('idunitkerja',$transaksi->idunitkerja)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('id', 'DESC')
            ->first();
        return view('report.spp', ['transaksi' => $transaksi, 'otorisator' => $otorisator, 'bendahara' => $bendahara, 'saldo' => $saldo]);
    }
    public function spm(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        return view('report.spm', ['transaksi' => $transaksi]);
    }
}
