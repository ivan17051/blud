<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Datatables;
use App\UnitKerja;
use App\Rekanan;
use App\BukuBank;
use App\SubKegiatan;
use App\Rekening;
use DB;

class BukuBankController extends Controller
{
    
    public function bukuBank(){
        $bulan = Carbon::now();
        $user = Auth::user();
        if($user->role=='PKM'){
            $pkm = UnitKerja::where('id', $user->idunitkerja)->first();
            $bukuBank = BukuBank::where('isactive', 1)->where('idunitkerja', $pkm->id)
                ->whereYear('tanggal', $bulan->year)->whereMonth('tanggal', $bulan->month)->get();
        }
        else{
            $pkm = 0;
            $bukuBank = [];
        }
        return view('bukuBank', ['bukuBank' => $bukuBank, 'bulan' => $bulan->format('m/Y'), 'pkm' => $pkm->id]);
    }

    public function bukuBankTable(Request $request){
        $bulan = Carbon::createFromFormat('m/Y', $request->bulan);
        $bukuBank = BukuBank::where('isactive', 1)->where('idunitkerja', $request->PKM)
                ->whereYear('tanggal', $bulan->year)->whereMonth('tanggal', $bulan->month)->get();
        // dd($request);
        return view('bukuBank', ['bukuBank' => $bukuBank, 'bulan'=>$request->bulan, 'pkm'=>$request->PKM]);
    }

    public function store(Request $request){
        $data = $request->validate([
            "noref" => "required",
            "tanggalref" => "required",
            "tanggal" => "required",
            "jenis" => "required",
            "uraian" => "required",
            "nominal" => "required",
        ]);
        try {
            $bukuBank = new BukuBank($data);
            $bukuBank->idunitkerja = Auth::user()->idunitkerja;
            $bukuBank->idc = Auth::id();
            $bukuBank->idm = Auth::id();
            
            $bukuBank->save();
        }catch (QueryException $exception) {
            return redirect(url('/bukuBank'))->with('error', $exception->getMessage());
        }
        return redirect(url('/bukuBank'))->with('success','Data Berhasil Ditambahkan');
    }

    public function delete(Request $request){
        // dd($request);
        $user = Auth::user();
        $userId = $user->id;
        try {
            $model=BukuBank::find($request->input('id'));
            if($user->idunitkerja !== $model->idunitkerja
                OR $model->status===3){
                throw new \Exception("restricted");
            }
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return redirect()->action('BukuBankController@bukuBankTable', ['request'=>$request])->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }
}
