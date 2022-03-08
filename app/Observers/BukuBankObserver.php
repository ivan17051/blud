<?php

namespace App\Observers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\SaldoBukuBank;
use App\BukuBank;

class BukuBankObserver
{
    
    public function saving(BukuBank $bukubank)
    {
        DB::beginTransaction();
        try {
            $old = BukuBank::find($bukubank->id);
            // jika create baru
            if(!$old){
                $old=(object) array('jenis'=>0, 'nominal'=>0);
                $this->updateSaldo($bukubank->idunitkerja , $bukubank->jenis, $old->jenis, $bukubank->tanggal, $bukubank->nominal, $old->nominal);
            }
            // jika dihapus
            elseif($bukubank->isactive==0){
                $this->updateSaldo($bukubank->idunitkerja , $bukubank->jenis, $old->jenis, $bukubank->tanggal, 0, $old->nominal);
            }
            else{
                $this->updateSaldo($bukubank->idunitkerja , $bukubank->jenis, $old->jenis, $bukubank->tanggal, $bukubank->nominal, $old->nominal);
            }
        }catch (\Exception $exception) {
            DB::rollBack();
        }
        DB::commit();
    }

    private function updateSaldo($idunitkerja, $jenis_new, $jenis_old, $tanggal, $saldo_new, $saldo_old){
        $tanggal = substr($tanggal,0,8)."01";
        $tanggal2 = Carbon::make($tanggal);
        $tanggal_now = Carbon::now()->translatedFormat('Y-m-')."01";
        
        $saldo=SaldoBukuBank::where('idunitkerja', $idunitkerja)->whereYear('tanggal',$tanggal2->year)->whereMonth('tanggal',$tanggal2->month)->first();
        
        if($saldo === NULL){
            if($tanggal2->month==1){
                $saldo_awal = SaldoBukuBank::where('idunitkerja', $idunitkerja)->whereYear('tanggal',$tanggal2->year-1)->whereMonth('tanggal',12)->first();
            }
            else{
                $saldo_awal = SaldoBukuBank::where('idunitkerja', $idunitkerja)->whereYear('tanggal',$tanggal2->year)->whereMonth('tanggal',$tanggal2->month-1)->first();
            }
            $saldo = new SaldoBukuBank([
                'idunitkerja'=>$idunitkerja,
                'jenis'=>0,
                'nominal'=>$saldo_awal->nominal+$saldo_new,
                'tanggal'=>$tanggal,
                'idc'=>Auth::id(),
                'idm'=>Auth::id()
            ]);
        }
        
        //pastikan jenis sesuai untuk menjumlah saldo
        elseif($jenis_new==1 && $jenis_old==1){
            $saldo->nominal-=$saldo_old;
            $saldo->nominal+=$saldo_new;
        }
        elseif($jenis_new==1 && $jenis_old==0){
            $saldo->nominal+=$saldo_old;
            $saldo->nominal+=$saldo_new;
        }
        elseif($jenis_new==0 && $jenis_old==1){
            $saldo->nominal-=$saldo_old;
            $saldo->nominal-=$saldo_new;
        }
        elseif($jenis_new==0 && $jenis_old==0){
            $saldo->nominal+=$saldo_old;
            $saldo->nominal-=$saldo_new;
        }
        
        $saldo->save();
        if($tanggal_now>$tanggal){
            $tanggal = Carbon::make($tanggal);
            $tanggal_now = Carbon::make($tanggal_now);
            for($x=$tanggal->month+1;$x<=$tanggal_now->month;$x++){
                $saldo=SaldoBukuBank::where('idunitkerja', $idunitkerja)->whereYear('tanggal', $tanggal->year)->whereMonth('tanggal', $x)->first();
                if($jenis_new==1 && $jenis_old==1){
                    $saldo->nominal-=$saldo_old;
                    $saldo->nominal+=$saldo_new;
                }
                elseif($jenis_new==1 && $jenis_old==0){
                    $saldo->nominal+=$saldo_old;
                    $saldo->nominal+=$saldo_new;
                }
                elseif($jenis_new==0 && $jenis_old==1){
                    $saldo->nominal-=$saldo_old;
                    $saldo->nominal-=$saldo_new;
                }
                elseif($jenis_new==0 && $jenis_old==0){
                    $saldo->nominal+=$saldo_old;
                    $saldo->nominal-=$saldo_new;
                }
                $saldo->save();
            }
        }
    }

}
