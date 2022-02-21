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
        $user = Auth::user();
        if($user->role=='PKM'){
            $pkm = UnitKerja::where('id', $user->id)->first();
        }
        else{
            $pkm = 0;
        }
        
        return view('bukuBank', ['bukuBank' => [], 'bulan' => 0, 'pkm' => $pkm]);
    }

    public function bukuBankTable(Request $request){
        
        $bulan = Carbon::createFromFormat('m/Y', $request->bulan);
        $bukuBank = BukuBank::where('idunitkerja', $request->PKM)->whereYear('tanggal', $bulan->year)->whereMonth('tanggal', $bulan->month)->get();
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
            $bukuBank = new \App\BukuBank($data);
            dd($bukuBank);
            $jurnal->idc = Carbon::createFromFormat('d/m/Y', $data['tanggal'])->format('Y-m-d');
            $bulan = Carbon::createFromFormat('d/m/Y', $data['tanggal'])->month;
            
            // Jika pengisian lebih dari today
            if($jurnal->tanggal > $today){
                $this->flashError('Tanggal Melebihi Hari Ini: '.$today->isoFormat('D MMMM Y'));
                return redirect(url('/'.$tipe->tipe.'/jurnal'));
            }
            // Jika selisih pengisian & today lebih dari 14 hari
            elseif($bulan != Carbon::today()->month){
                $this->flashError('Tanggal Sudah Melewati Batas Waktu Pengisian');
                return redirect(url('/'.$tipe->tipe.'/jurnal'));
            }
            $jurnal->save();
        }catch (QueryException $exception) {
            return redirect(url('/'.$tipe->tipe.'/jurnal'))->with('error', $exception->getMessage());
        }

        return redirect(url('/bukuBank'))->with('success','Data Jurnal Berhasil Ditambahkan');
    }
}
