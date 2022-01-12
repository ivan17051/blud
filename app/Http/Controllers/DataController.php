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
        $listKegiatan = Kegiatan::all();
        $subkegiatan = SubKegiatan::with(['getKegiatan' => function($query) { 
            $query->select('id', 'kode', 'nama');}])->where('isactive', 1)->get();
        return view('masterData.subkegiatan', ['subkegiatan' => $subkegiatan, 'kegiatan' => $listKegiatan]);
    }

    public function rekening(){
        return view('masterData.rekening');
    }

    public function pejabat(){
        return view('masterData.pejabat');
    }

    public function rekanan(){
        return view('masterData.rekanan');
    }

    public function storeUpdatePejabat(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable',
            'idunitkerja' => 'required|exists:munitkerja,id',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'nip' => 'nullable|string',
            'golongan' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'rekening' => 'nullable|string'
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $input = $validator->valid();
        if(isset($input->id)){
            $model = Pejabat::firstOrNew([
                'id' => $input->id
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
            'id' => 'nullable',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);
        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $input = $validator->valid();
        if(isset($input->id)){
            $model = Rekanan::firstOrNew([
                'id' => $input->id
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
}
