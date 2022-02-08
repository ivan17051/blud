<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UnitKerja;
use App\Kegiatan;
use App\SubKegiatan;
use App\Pejabat;
use App\Rekanan;
use App\Rekening;
use App\User;
use App\Saldo;
use App\Pajak;
use Validator;
use Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    public function dashboard(){
        $user=Auth::user();
        if(in_array($user->role,['PKM'])){
            $subkegiatan=SubKegiatan::where('idunitkerja',$user->idunitkerja)->where('isactive',1)->select('id','kode','nama')->get();
        }else{
            $subkegiatan=SubKegiatan::where('isactive',1)->select('id','kode','nama')->get();
        }
        
        return view('dashboard',['subkegiatan'=>$subkegiatan]);
    }

    public function unitKerja(){
        $unitKerja = UnitKerja::select('id', 'nama', 'nama_alias', 'alamat')->get();
        return view('masterData.unitKerja', ['unitKerja' => $unitKerja]);
    }

    public function kegiatan(){
        $kegiatan = Kegiatan::where('isactive', 1)->get();
        return view('masterData.kegiatan', ['kegiatan' => $kegiatan]);
    }

    public function subkegiatan(){
        $listKegiatan = Kegiatan::where('isactive', 1)->get();
        $pejabat = Pejabat::where('isactive', 1)->get();
        $subkegiatan = SubKegiatan::with(['getKegiatan' => function($query) { 
            $query->select('id', 'kode', 'nama');}])->where('isactive', 1)->get();
        return view('masterData.subkegiatan', ['subkegiatan' => $subkegiatan, 'kegiatan' => $listKegiatan, 'pejabat' => $pejabat]);
    }

    public function rekening(){
        $rekening = Rekening::where('isactive', 1)->get();
        return view('masterData.rekening', ['rekening' => $rekening]);
    }

    public function pejabat(){
        $user = Auth::user();
        $unitKerja=UnitKerja::where('id',$user->idunitkerja)->select('id','nama','nama_alias')->get();
        if(in_array($user->role,['admin','PIH'])){
            $pejabat = Pejabat::where('isactive', 1)->get();
        }else{
            $pejabat = Pejabat::where('isactive', 1)->where('idunitkerja',$user->idunitkerja)->get();
        }        
        return view('masterData.pejabat', ['pejabat' => $pejabat, 'role' =>$user->role, 'unitkerja'=>$unitKerja]);
    }

    public function rekanan(){
        $rekanan = Rekanan::where('isactive', 1)->get();
        return view('masterData.rekanan', ['rekanan' => $rekanan]);
    }

    public function user(){
        $user = User::where('isactive', 1)->with('unitkerja')->get();
        return view('masterData.user', ['user' => $user]);
    }

    public function saldo(Request $request){
        return view('masterData.saldo');
    }

    public function saldoTable(Request $request, $idunitkerja){
        $datatable = Datatables::of(Rekening::select('id','kode','nama')->with(['saldo'=>function($q) use($idunitkerja){
            $q->select('id','idunitkerja','idrekening','saldo','tanggal','tipe')
                ->where('idunitkerja',$idunitkerja)
                ->orderBy('tanggal','DESC');
            }])->orderBy('id','ASC')
        );
        $datatable->addIndexColumn()
            ->editColumn('tanggal', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->addColumn('anggaran',function($t){
                if($t->saldo->isEmpty()) return 0;
                return number_format($t->saldo->last()->saldo - 0,0,',','.');
            })
            ->addColumn('realisasi',function($t){
                if($t->saldo->isEmpty()) return 0;
                return number_format($t->saldo->last()->saldo - $t->saldo->first()->saldo,0,',','.');
            })
            ->addColumn('edit', function ($t) { 
                return '<button onclick="tambah(this)" class="btn btn-sm btn-outline-warning border-0 text-nowrap" title="sunting">&nbsp<i class="fas fa-edit fa-sm"></i>&nbsp</button>';
            })
            ->addColumn('action', function ($t) { 
                return '<button onclick="show(this)" class="btn btn-sm btn-outline-success border-0 dt-control" title="info"><i class="fas fa-plus fa-md"></i></button>';
            })
            ->rawColumns(['edit','action']);;
        return $datatable->make(TRUE);
    }

    public function pajak(){
        $pajak = Pajak::where('isactive', 1)->get();
        $parent = Pajak::where('isactive', 1)->where('parent',null)->get();
        return view('masterData.pajak', ['pajak' => $pajak, 'parent'=>$parent]);
    }

    public function storeUpdateKegiatan(Request $request){
        $userId = Auth::id();
        
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mkegiatan,id',
            'kode' => 'required|string',
            'nama' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        if(isset($input['id'])){
            $model = Kegiatan::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new Kegiatan();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeUpdateSubKegiatan(Request $request){
        $userId = Auth::id();
        
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:msubkegiatan,id',
            'idunitkerja' => 'integer',
            'idkegiatan' => 'required|integer',
            'idpejabat' => 'required|integer',
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tanggal' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        
        if(isset($input['id'])){
            $model = SubKegiatan::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new SubKegiatan();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeUpdateRekening(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mrekening,id',
            'kode' => 'required|string',
            'nama' => 'required|string',
        ]);        
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        if(isset($input['id'])){
            $model = Rekening::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new Rekening();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeUpdatePejabat(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mpejabat,id',
            'idunitkerja' => 'required|exists:munitkerja,id',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'nip' => 'nullable|string',
            'golongan' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'rekening' => 'nullable|string'
        ]);        
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        if(isset($input['id'])){
            $model = Pejabat::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new Pejabat();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeUpdateRekanan(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mrekanan,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'namabank' => 'required|string|max:20',
            'pimpinan' => 'nullable|string|max:255',
            'rekening' => 'required|string|max:100',
            'atasnama' => 'required|string|max:100',
            'npwp' => 'nullable|string|max:15',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        if(isset($input['id'])){
            $model = Rekanan::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new Rekanan();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeUpdateUser(Request $request){
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:muser,id',
            'username' => 'required_without:id|string|max:191',
            'nama' => 'required|string|max:20',
            'password' => 'required_without:id|string|min:1|confirmed',
            'role'=>'required|string',
            'idunitkerja'=>'required|exists:munitkerja,id',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        $input['isactive']=1;

        // cek username terpakai sebelumnya tidak
        if(isset($input['username'])){
            $model=User::where('username',$input['username'])->first();
            if(isset($model) AND $model['isactive']===1){
                return back()->with('error','Username telah digunakan');
            }
        }

        if (isset($input['password'])) {
            $input['password']=Hash::make($input['password']);
        }

        if(isset($input['id']) and isset($model)===FALSE){
            $model = User::firstOrNew([
                'id' => $input['id']
            ]);
        }else if(isset($model)===FALSE){
            $model = new User();
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function storeSaldo(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'idrekening'=>'required|exists:mrekening,id',
            'idunitkerja'=>'required|exists:munitkerja,id',
            'saldo'=> array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            // 'tanggal'=>'required',
            'keterangan'=>'nullable',
            'isall'=>'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->route('saldo',$input)->with('error','Gagal menyimpan');;
        }

        $input = $validator->valid();
        $tanggal= Carbon::now()->format('Y').'-01-01';

        //jika set untuk semua PKM
        if(isset($input['isall'])){
            $unitkerja=[37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,
                61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,
                86,87,88,89,90,103,104,117,121,122,135,138,148,151,984];
        }else{
            $unitkerja=[$request->input('idunitkerja')];
        }
        
        try {
            DB::beginTransaction();
            foreach ($unitkerja as $uk) {
                $input['idunitkerja']=$uk;

                //cek apakah rekening sudah ada inputan puskesmas
                $saldos_cnt=Saldo::where('idunitkerja',$uk)
                    ->where('idrekening',$input['idrekening'])
                    ->where('tipe', null)
                    ->count();
                
                if($saldos_cnt){
                    throw new \Exception("Rekening sedang digunakan.");
                }

                $model = Saldo::firstOrNew([
                    'tipe' => 'saldo awal',
                    'tanggal' => $tanggal,
                    'idrekening'=>$input['idrekening'],
                    'idunitkerja'=> $uk,
                ]);

                if(isset($model->id)===FALSE){
                    $model->fill(['idc'=>$userId]);
                }
                $model->fill($input);
                $model->fill(['idm'=>$userId]);
                $model->save();
            }
            DB::commit();
            return redirect()->route('saldo',$input)->with('success','Berhasil menyimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function storeUpdatePajak(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mrekening,id',
            'kode' => 'required|string',
            'nama' => 'required|string',
            'parent' => 'nullable|exists:mpajak,id',
        ]);        
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        if($input['parent']===''){
            unset($input['parent']);
        }
        
        if(isset($input['id'])){
            $model = Pajak::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$userId
            ]);
        }else{
            $model = new Pajak();
            $model->fill([
                'idc'=>$userId,
                'idm'=>$userId
            ]);
        }
        $model->fill($input);
        
        $model->save();
        return back()->with('success','Berhasil menyimpan');
    }

    public function deleteKegiatan(Request $request){
        $userId = Auth::id();
        try {
            $model=Kegiatan::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deleteSubKegiatan(Request $request){
        $userId = Auth::id();
        try {
            $model=SubKegiatan::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deleteRekening(Request $request){
        $userId = Auth::id();
        try {
            $model=Rekening::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deletePejabat(Request $request){
        $userId = Auth::id();
        try {
            $model=Pejabat::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deleteRekanan(Request $request){
        $userId = Auth::id();
        try {
            $model=Rekanan::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deleteUser(Request $request){
        $userId = Auth::id();
        try {
            $model=User::find($request->input('id'));
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function deletePajak(Request $request){
        $userId = Auth::id();
        try {
            $model=Pajak::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }

    public function getPejabatByUnitKerja($idunitkerja){
        $pejabat = Pejabat::select('id','idunitkerja','nama','nip')->where('isactive', 1)->where('idunitkerja',$idunitkerja)->get();
        return response()->json($pejabat, 200);
    }
}
