<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class ForgotController extends Controller
{
    public function index(Request $request)
    {
        return view('layouts.forgot');
    }
    public function store(Request $request)
    {
        $user = User::where('email',$request->email)
                    ->where('aktif','Y')
                    ->get();
        if ($user->count() == 1) {
            //Send Email
            $this->sendEmail($user->first());
        }else  if ($user->count() > 1) {
            return redirect()->route('forgot')->with('gagal','Email Tidak Valid');
        }
        else{
            return redirect()->route('forgot')->with('gagal','Email Tidak Terdaftar');
        }
    }
    public function updatePassword(Request $request,$mail)
    {
        $rules = [
            'password' => 'required|min:6',
            'repassword' => 'required_with:password|same:password|min:6',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min'=> ':attribute minimal 6 huruf.',
            'same' => 'The :attribute and :other must match.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        try {
            $decrypted = Crypt::decryptString($mail);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            if(app()->runningUnitTests())
                return $value;
            else
                throw $e;
        }
        $user = User::where('email',$decrypted)
                    ->where('aktif','Y')
                    ->update([
                        'password' => bcrypt($request->password)
                    ]);
         return redirect('/')->with('sukses','Password Berhasil di Perbaharui');

    }
    public function pageChangePassword(Request $request,$mail)
    {
        try {
            $decrypted = Crypt::decryptString($mail);
        }catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            if(app()->runningUnitTests())
                return $value;
            else
                throw $e;
        }
        $user = User::where('email',$decrypted)
                    ->where('aktif','Y')
                    ->get()
                    ->count();
        if ($user==1) {
            return view('layouts.forgotchange',compact('mail'));
        }else{
            return redirect()->route('auth');
        }
    }

    public function sendEmail($user)
    {
        $nama = $user->name;
        $email = $user->email;
        $crypEmail = Crypt::encryptString($email);
        $url = url('/fgt/'.$crypEmail."/forgot");
        $send = Mail::to($email)->send(new ForgotMail($nama,$url));
        if ($send) {
            return redirect('/')->with('sukses','Link Halaman Ganti Password dikirimkan ke email');
        }
    }
}
