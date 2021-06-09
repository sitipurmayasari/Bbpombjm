<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check()){
            return view('layouts.login');
        }else{
           return redirect('/portal');
        }
    }
    public function auth(Request $request)
    {    
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt([
                 'email' => request('email'),
                 'password' => request('password'),
                 'aktif' => 'Y'
                 ])){
                return redirect('/portal')->with('sukses','Selamat, Anda berhasil masuk aplikasi');
                // return redirect('/layouts/portal')->with('sukses','Selamat, Anda berhasil masuk aplikasi');
        }else{
            return redirect('/')->with('gagal','mohon masukkan password dengan benar');
        }
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }
}
