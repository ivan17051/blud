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
use Datatables;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $user = Auth::user();
        $subkegiatan=SubKegiatan::where('isactive', 1)->where('idunitkerja', Auth::user()->idunitkerja)->get();
        $rekening=Rekening::where('isactive', 1)->select('id','kode','nama')->get();
        $rekanan=Rekanan::where('isactive', 1)->select('id','nama')->get();
        $pejabat=Pejabat::where('isactive', 1)->select('id','idunitkerja','nama','nip','jabatan','rekening')->where('idunitkerja',$user->idunitkerja)->get();
        $pajakParent=Pajak::where('isactive', 1)->select('parent')->distinct()->where('parent','<>',null)->pluck('parent')->toArray();
        $pajak=Pajak::where('isactive', 1)->whereNotIn('id',$pajakParent)->select('id','kode','nama','parent')->get();
        return view('transaksi',['subkegiatan'=>$subkegiatan, 'rekening'=>$rekening, 'rekanan'=>$rekanan, 'user'=>$user, 'pejabat'=>$pejabat, 'pajak'=>$pajak]);
    }

    public function data(Request $request){
        $user = Auth::user();
        if(in_array($user->role,['admin','PIH','KEU'])){
            $data = Transaksi::where('transaksi.isactive',1)
                ->where('status','>',1)->with(['unitkerja','subkegiatan'])
                ->orderBy('id','DESC');;
                // status lebih dari 1 artinya sudah masuk pengajuan sp2d
        }else{
            $data = Transaksi::where('isactive',1)->with(['unitkerja','subkegiatan'])
                    ->where('idunitkerja',$user->idunitkerja)
                    ->orderBy('id','DESC');
        }
        
        $datatable = Datatables::of($data);
        $datatable->addColumn('tanggal_raw', function ($t) { return $t->tanggal; })
            ->editColumn('tanggalref', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->addIndexColumn()
            ->addColumn('tipe_raw', function ($t) { return $t->tipe; })
            ->editColumn('tipe', function ($t) { 
                switch ($t->tipe) {
                    case 'TU':
                        return "<span class=\"badge bg-success text-white\">TU</span>";
                        break;
                    case 'LS':
                        return "<span class=\"badge bg-primary text-white\">LS</span>";
                        break;
                    default:
                        return "<span class=\"badge bg-info text-white\">UP</span>";
                        break;
                }
            })
            ->editColumn('jenis', function ($t) { 
                return $t->jenis===1?"<p class=\"text-success\"><b><i class=\"fas fa-arrow-up fa-sm\"></i>&nbspdebit</b></p>":"<p class=\"text-danger\"><b><i class=\"fas fa-arrow-down fa-sm\"></i>&nbspkredit</b></p>";
            })
            ->addColumn('status_raw', function ($t) {
                return $t->status;
            })
            ->editColumn('jumlah', function ($t){
                return number_format($t->jumlah,0,',','.');
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
                // ->addColumn('sptb',function($t){
                //     return '<button class="btn btn-sm btn-primary " onclick="cetak(\'sptb\',\''.$t->id.'\')">Cetak</button>';
                // })
                // ->addColumn('spp',function($t){
                //     return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spp\',\''.$t->id.'\')">Cetak</button>';
                // })
                // ->addColumn('spm',function($t){
                //     return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spm\',\''.$t->id.'\')">Cetak</button>';
                // })
                ->addColumn('sp2d',function($t){
                    if($t->status===3){
                        //sp2d telah di-acc
                        return '<button disabled class="btn btn-sm btn-success d-block mb-2 text-nowrap"><i class="fas fa-lock fa-sm"></i> Diterima</button>'.
                                '<button class="btn btn-sm btn-primary " onclick="cetak(\'sp2d\',\''.$t->id.'\',\''.$t->tipepembukuan.'\')">Cetak</button>';
                    }
                    else if($t->status===2){
                        //Tombol acc untuk sp2d
                        return '<a href="javascript:void(0);" class="btn btn-sm btn-danger " onclick="tolak(this)"><i class="fas fa-times fa-sm"></i> Tolak</a>'.
                            '<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="acc(this)"><i class="fas fa-check fa-sm"></i> Terima</a>'.
                            '<button class="btn btn-sm btn-info " onclick="cetak(\'sp2d\',\''.$t->id.'\',\''.$t->tipepembukuan.'\')"> Preview</button>';
                    }
                    else if($t->status===4){  
                        //4 artinya revisi
                        return '<button disabled class="btn btn-sm btn-danger btn-outline-default mb-2 border-0" title="revisi"><i class="fas fa-times fa-sm"></i> Ditolak</button>';
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
                    if ($t->status<2 || $t->status==4) {
                        $html.='<button onclick="edit(this)" class="btn btn-sm btn-outline-warning border-0" style="width:2rem;" title="Sunting Transaksi" data-toggle="modal" data-target="#sunting"><i class="fas fa-edit fa-sm"></i></button>';
                        $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" style="width:2rem;" title="Hapus Transaksi"><i class="fas fa-trash fa-sm"></i></button>';
                    }
                    $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" style="width:2rem;" title="Info"><i class="fas fa-ellipsis-v fa-sm"></i></button>';
                    return $html;
                })
                ->addColumn('spp',function($t){
                    return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spp\',\''.$t->id.'\')" title="Cetak SPP">Cetak</button>';
        
                })
                ->addColumn('spm',function($t){
                    if($t->status<1){
                        //tombol membuat spm
                        return '<button class="btn btn-sm btn-warning " onclick="buatSpm(this)">Buat</button>';
                    }
                    else{
                        return '<button class="btn btn-sm btn-primary " onclick="cetak(\'spm\',\''.$t->id.'\')" title="Cetak SPM">Cetak</button>';
                    }
                })
                ->addColumn('sp2d',function($t){
                    if($t->status===3){
                        //sp2d telah di-acc
                        $toBKU_btn='<button class="btn btn-sm btn-warning " onclick="transaksi2bku(this)" title="to BKU">to BKU</button>';
                        if($t->isbku===1) $toBKU_btn='<button class="btn btn-sm btn-warning " disabled title="to BKU"><i class="fas fa-lock fa-sm"> to BKU</button>';
                        return '<button disabled class="btn btn-sm btn-success d-block mb-2 text-nowrap"><i class="fas fa-lock fa-sm"></i> Diterima</button>'.
                            '<button class="btn btn-sm btn-primary mb-2" onclick="cetak(\'sp2d\',\''.$t->id.'\',\''.$t->tipepembukuan.'\')" title="Cetak SP2D">Cetak</button>'.
                            $toBKU_btn;
                    }
                    else if($t->status===2){
                        //menunggu di-acc
                        return '<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="batal(this)"><i class="fas fa-ban fa-sm"></i> Batal</a>';
                    }
                    else if($t->status===1 or $t->status===4){  //4 artinya revisi
                        //boleh mengajukan
                        $html='';
                        if($t->status===4){  
                            $html.='<button disabled class="btn btn-sm btn-danger btn-outline-default mb-2 border-0" title="revisi"><i class="fas fa-times fa-sm"></i> Ditolak</button>';
                        }
                        return $html.'<a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="acc(this)" title="Forward"><i class="fas fa-paper-plane fa-sm"></i> Fwd</a>';
                    }
                    else{
                        return '<button disabled class="btn btn-sm btn-outline-default border-0" title="Terkunci"><i class="fas fa-lock fa-sm"></i></button>';
                    }
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

    public function storeUpdateTransaksi(Request $request){
        $user = Auth::user();
        // $input = array_map('trim', $request->all());
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            'tipe' => 'required_without:id|string|in:UP,LS,TU',
            // 'jenis' => 'required|in:0,1',
            'tanggalref' => 'required_without:id|string',
            'idsubkegiatan' => 'required_without:id|integer',
            'kodetransaksi' => 'nullable',
            'kodepekerjaan' => 'nullable',
            'isspj' => 'nullable',
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
            'dibayarkan' => 'required_without:id|integer',
            // 'tipepembukuan' => 'nullable|string|in:pindahbuku,tunai',
            // 'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'keterangan' => 'required_without:id|string|max:255',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        $input['idunitkerja']=$user->idunitkerja;
        $idunitkerja=$user->idunitkerja;
        if(isset($input['idrekanan'])){
            $input['idkepada']=$input['idrekanan'];
        }
        if(isset($input['dibayarkan'])){
            $input['flagkepada']=$input['dibayarkan'];
        }

        //membuat array rekening untuk db dng urutan [id, kode, nama rekening, jumlah]
        $newRekeningArray=[];
        $newJumlah=0;
        $newSaldo=0;
        if(isset($input['rekening']) ){
            foreach ($input['rekening'] as $i=>$idrekening) {
                $rekening=Rekening::where('id',$idrekening)->select('id','kode','nama')->with(['saldo'=>function($q) use($idunitkerja){
                    $q->select('id','idunitkerja','idrekening','saldo','tanggal','tipe')
                        ->where('idunitkerja',$idunitkerja)
                        ->orderBy('tanggal','DESC')
                        ->first();
                    }])->first()->toArray();
                $newJumlah+=floatval($input['jumlah'][$i]);

                try {
                    $saldo=$rekening['saldo'][0];
                    $saldoValue=$saldo['saldo']-floatval($input['jumlah'][$i]);
                    if($saldoValue < 0){   //cek kecukupan saldo
                        throw new Exception("Saldo tidak mencukupi");
                    }
                    $newSaldo+=$saldoValue;
                } catch (\Throwable $th) {
                    return back()->with('error','Saldo tidak mencukupi');
                }

                unset($rekening['saldo']);
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
                $t->saldo=$newSaldo;
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
            $input['jumlah']=$newJumlah;
            $input['rekening']=$newRekeningArray;
            $input['pajak']=$newPajakArray;
            $input['potongan']=$newPotonganArray;

            $input['jumlah']=$newJumlah;
            $input['rekening']=$newRekeningArray;

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
                'nomor'=>$nomor,
                'saldo'=>$newSaldo
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

                    array_push($riwayat,[$tgl,$userId,"Membuat SPM"]);
                    $model->riwayat=$riwayat;
                    $model->tipepembukuan=$request->input('tipepembukuan');
                    break;
                case 1:
                    //pengajuan sp2d
                    $model->status=2;
                    array_push($riwayat,[$tgl,$userId,"Pengajuan SP2D"]);
                    $model->riwayat=$riwayat;
                    break;
                case 2:
                    //acc sp2d
                    $model->status=3;
                    array_push($riwayat,[$tgl,$userId,"SP2D disetujui"]);
                    $model->riwayat=$riwayat;
                    break;
                case 4:
                    if($user->role==='PKM'){
                        //setelah merevisi, mengajukan sp2d kembali
                        $model->status=2;
                        array_push($riwayat,[$tgl,$userId,"Pengajuan SP2D (revisi)"]);
                        $model->riwayat=$riwayat;
                    }elseif($user->role==='KEU'){
                        //acc sp2d tapi dari hasil revisi
                        $model->status=3;
                        array_push($riwayat,[$tgl,$userId,"Permintaan Revisi"]);
                        $model->riwayat=$riwayat;
                    }
                    break;
            }

            if($model->isClean()){
                throw new \Exception('Tidak ada perubahan');
            }

            //setelah ada persetujuan sp2d dari keuangan
            if($model->status === 3){
                $newSaldo=0;
                $idunitkerja=$model->idunitkerja;
                
                foreach ($model->rekening as $i=>$rekeningArr) {
                    $saldo=Saldo::select('id','idunitkerja','idrekening','saldo','tanggal','tipe')->where('idrekening',$rekeningArr[0])->where('idunitkerja', $idunitkerja)->orderBy('tanggal','DESC')->first();

                    if(isset($saldo)===FALSE){   //cek row saldo ada atau tidak
                        throw new Exception("Saldo tidak mencukupi");
                    }

                    $saldoValue=$saldo['saldo']-floatval($rekeningArr[3]);  //index 3 adalah jumlah yg digunakan
                    if($saldoValue < 0){   //cek kecukupan saldo
                        throw new Exception("Saldo tidak mencukupi");
                    }
                    $newSaldo+=$saldoValue;

                    if (in_array($saldo->tipe, ['saldo awal','revisi'])) {
                        $saldo= $saldo->replicate();
                        $saldo->fill([
                            'saldo'=>$saldoValue,
                            'tanggal'=>Carbon::now()->format('Y-m-d'),
                            'idm'=>$userId,
                            'idc'=>$userId,
                            'tipe'=>null,
                        ]);
                    }else{
                        $saldo->fill([
                            'saldo'=>$saldoValue,
                            'tanggal'=>Carbon::now()->format('Y-m-d'),
                            'idm'=>$userId,
                        ]);
                    }
                    $saldo->save();
                }
                $model->saldo=$newSaldo;
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
        // $otorisator = Pejabat::select('id', 'nama', 'nip', 'jabatan')->findOrFail($request->idotorisator);
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'KPA')->first();
        return view('report.sptb', ['transaksi' => $transaksi, 'otorisator' => $otorisator]);
    }
    public function ceklist(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'PPK UPTD')->first();
        return view('report.ceklist', ['transaksi' => $transaksi, 'otorisator' => $otorisator]);
    }
    public function spp(Request $request, $id){
        // $otorisator = Pejabat::select('id', 'nama', 'nip', 'jabatan')->findOrFail($request->idotorisator);
        // $bendahara = Pejabat::findOrFail($request->idbendahara);
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $bendahara = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'Bendahara Pengeluaran')->first();
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'KPA')->first();
        return view('report.spp', ['transaksi' => $transaksi, 'otorisator' => $otorisator, 'bendahara' => $bendahara ]);
    }
    public function sppup(Request $request, $id){
        // $otorisator = Pejabat::select('id', 'nama', 'nip', 'jabatan')->findOrFail($request->idotorisator);
        // $bendahara = Pejabat::findOrFail($request->idbendahara);
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $bendahara = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'Bendahara Pengeluaran')->first();
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'KPA')->first();
        return view('report.sppup', ['transaksi' => $transaksi, 'otorisator' => $otorisator, 'bendahara' => $bendahara]);
    }
    public function spm(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $bendahara = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'Bendahara Pengeluaran')->first();
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'KPA')->first();
        return view('report.spm', ['transaksi' => $transaksi, 'bendahara' => $bendahara, 'otorisator' => $otorisator]);
    }
    public function sp2d(Request $request, $id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan'])->find($id);
        $unitkerja = UnitKerja::where('id', $transaksi->idunitkerja)->first();
        $bendahara = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'Bendahara Pengeluaran')->first();
        $otorisator = Pejabat::where('idunitkerja', $transaksi->idunitkerja)->where('jabatan', 'KPA')->first();
        return view('report.sp2d', ['transaksi' => $transaksi, 'bendahara' => $bendahara, 'otorisator' => $otorisator, 'unitkerja' => $unitkerja, 'request' => $request]);
    }
}
