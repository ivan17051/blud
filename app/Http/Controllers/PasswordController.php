<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;

class PasswordController extends Controller
{
    public function update(Request $request){
        $user = Auth::user();
        $check = Hash::check($request->pass_sekarang, $user->password);
        if($check){
            $pass_baru = User::find($user->id);
            if($request->pass_baru_konfirm==$request->pass_baru){
                $pass_baru->password = Hash::make($request->pass_baru);
                $pass_baru->save();
                return back()->with('success', 'Password Diperbarui');
            }
            else{
                return back()->with('error', 'Password Baru Tidak Sama');
            }
        }
        else{
            return back()->with('error', 'Password Lama Tidak Sesuai');
        }
        
        return back('welcome');
    }
}
