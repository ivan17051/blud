<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitKerja;
use App\Kegiatan;
use App\SubKegiatan;
use App\Pejabat;
use App\Rekanan;
use App\Rekening;
use App\User;
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
        // $userId = Auth::id();
        $userId = 1;
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:mkegiatan,id',
            'idgrup' => 'required|integer',
            'idkegiatan' => 'required|integer',
            'idpejabat' => 'required|integer',
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tahun' => 'required|string',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        // dd($input);
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
        // dd($model);
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
            'username' => 'required|string|max:191',
            'nama' => 'required|string|max:20',
            'password' => 'required_without:id|string|min:1|confirmed',
            'role'=>'required|string',
            'idunitkerja'=>'required|exists:munitkerja,id',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');

        $input = $validator->valid();
        $input['isactive']=1;

        // cek username terpakai sebelumnya tidak
        $model=User::where('username',$input['username'])->first();
        if($model->isactive===1){
            return back()->with('error','Username telah digunakan');
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
            $model=Kegiatan::find($request->input('id'));
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
            $model->idm=$userId;
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
            $model->idm=$userId;
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
