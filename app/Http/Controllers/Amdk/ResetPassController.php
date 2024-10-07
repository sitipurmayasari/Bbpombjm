<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Resetpass;
use Illuminate\Support\Str;


class ResetPassController extends Controller
{
    public function index(Request $request)
    {
        $data = Resetpass::orderBy('id','desc')
                            ->first();
        return view('amdk/resetpass.index',compact('data'));
    }

    public function store(Request $request)
    {
        
        if($request->newpass!=""){
            $request->merge([
                'password' =>  bcrypt($request->newpass),
                'remember_token' => Str::random(60)
            ]);                
        }
        $users = User::whereDate('updated_at','<',$request->resetbefore)
                    ->where('aktif','Y')
                    ->get();

        foreach ($users as $key => $value) {
            $value->update([
                'password' => bcrypt($request->newpass)
            ]);
        }

        Resetpass::create($request->all());
        

        return redirect('/amdk/resetpass')->with('sukses','Data Diperbaharui');
    }
}
