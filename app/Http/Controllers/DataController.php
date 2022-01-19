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
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    public function dashboard(){
        return view('dashboard');
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
        $grupSubkeg = SubKegiatan::where('isactive', 1)->get();
        $pejabat = Pejabat::where('isactive', 1)->get();
        $subkegiatan = SubKegiatan::with(['getKegiatan' => function($query) { 
            $query->select('id', 'kode', 'nama');}])->where('isactive', 1)->get();
        return view('masterData.subkegiatan', ['subkegiatan' => $subkegiatan, 'kegiatan' => $listKegiatan, 
            'grupSubkeg' => $grupSubkeg, 'pejabat' => $pejabat]);
    }

    public function rekening(){
        $listSubKegiatan = SubKegiatan::all();
        $rekening = Rekening::where('isactive', 1)->get();
        return view('masterData.rekening', ['subkegiatan' => $listSubKegiatan, 'rekening' => $rekening]);
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
        $subkegiatan=SubKegiatan::where('isactive', 1)->get();
        $saldos=NULL;
        if ($request->input('idgrup') and $request->input('idunitkerja')){
            $saldos=Saldo::where('idgrup',$request->input('idgrup'))
                ->where('idunitkerja',$request->input('idunitkerja'))
                ->orderBy('tanggal', 'asc')
                ->orderBy('id', 'asc')
                ->get();

            return view('masterData.saldo', ['subkegiatan'=>$subkegiatan, 'saldos'=>$saldos])
                ->withInput($request->input());
        }
        return view('masterData.saldo', ['subkegiatan'=>$subkegiatan, 'saldos'=>$saldos])->with('success','Berhasil menyimpan');
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
            'id' => 'nullable|exists:mkegiatan,id',
            'idgrup' => 'integer',
            'idkegiatan' => 'required|integer',
            'idpejabat' => 'required|integer',
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tanggal' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        // Menonaktifkan subkegiatan lama
        if(!empty($input['idgrup'])){
            $sublama = SubKegiatan::where('idgrup', $input['idgrup'])->where('isactive', 1)->get();
            foreach($sublama as $unit){
                $unit->isactive = 0;
                $unit->save();
            }
        }
        // Jika tdk menggantikan subkegiatan lama, maka buat grup baru
        else{
            DB::table('grupsubkegiatan')->insert(['isactive'=>1]);
            $input['idgrup']=DB::table('grupsubkegiatan')->max('id');
        }
        
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
            'idunitkerja'=>'required|exists:munitkerja,id',
            'idgrup'=>'required|exists:grupsubkegiatan,id',
            'saldo'=> array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'tanggal'=>'required',
            'keterangan'=>'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->route('saldo',$input)->with('success','Gagal menyimpan');;
        }

        $input = $validator->valid();
        $saldos=Saldo::where('idgrup',$request->input('idgrup'))
                ->where('idunitkerja',$request->input('idunitkerja'))
                ->get();
        $newsaldo=new Saldo();
        $newsaldo->fill($input);
        $newsaldo->fill(['idc'=>$userId,'idm'=>$userId]);
        if($saldos->count()){
            $newsaldo->tipe='revisi';
        }else{
            $newsaldo->tipe='inisial';
        }
        $newsaldo->save();
        return redirect()->route('saldo',$input)->with('success','Berhasil menyimpan');
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
}
