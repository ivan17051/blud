<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Datatables;
use App\UnitKerja;
use App\BukuBank;
use App\SaldoBukuBank;
use DB;

class BukuBankController extends Controller
{
    
    public function bukuBank(){
        $bulan = Carbon::now();
        $user = Auth::user();
        
        if($user->role=='PKM'){
            $pkm = UnitKerja::where('id', $user->idunitkerja)->first();
            $bukuBank = BukuBank::where('isactive', 1)->where('idunitkerja', $pkm->id)
                ->whereYear('tanggal', $bulan->year)->whereMonth('tanggal', $bulan->month)->get()
                ->sortBy('tanggal');
        }
        else{
            $pkm = (object) array('id'=>0);
            $bukuBank = [];
        }

        $saldo = SaldoBukuBank::where('idunitkerja', $user->idunitkerja)
            ->whereMonth('tanggal', $bulan->month-1)->first();
        if(!$saldo){
            $saldo=(object) array('nominal'=>0, 'jenis'=>1);
        }
        // dd($saldo);
        return view('bukuBank', ['bukuBank' => $bukuBank, 'bulan' => $bulan->format('m/Y'), 'pkm' => $pkm->id, 'saldoAwal' => $saldo]);
    }

    public function bukuBankTable(Request $request){
        $user = Auth::user();
        $bulan = Carbon::createFromFormat('m/Y', $request->bulan);
        $bukuBank = BukuBank::where('isactive', 1)->where('idunitkerja', $request->PKM)
                ->whereYear('tanggal', $bulan->year)->whereMonth('tanggal', $bulan->month)->get()
                ->sortBy('tanggal');
        $saldo = SaldoBukuBank::where('idunitkerja', $request->PKM)
                ->whereMonth('tanggal', $bulan->month-1)->first();
        if(!$saldo){
            $saldo=(object) array('nominal'=>0, 'jenis'=>1);
        }
        // dd($saldo);
        return view('bukuBank', ['bukuBank' => $bukuBank, 'bulan'=>$request->bulan, 'pkm'=>$request->PKM, 'saldoAwal'=>$saldo]);
    }

    public function storeUpdateBukuBank(Request $request){
        
        $user = Auth::user();
        
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:bukubank,id',
            "noref" => "required",
            "tanggalref" => "required",
            "tanggal" => "required",
            "jenis" => "required",
            "uraian" => "required",
            "nominal" => "required",
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        if(isset($input['id'])){
            $model = BukuBank::firstOrNew([
                'id' => $input['id']
            ]);
            $model->fill([
                'idm'=>$user->id
            ]);
        }else{
            $model = new BukuBank();
            $model->fill([
                'idunitkerja'=>$user->idunitkerja,
                'idc'=>$user->id,
                'idm'=>$user->id
            ]);
        }
        $model->fill($input);
        $model->save();
        return back()->with('success','Berhasil menyimpan');
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
