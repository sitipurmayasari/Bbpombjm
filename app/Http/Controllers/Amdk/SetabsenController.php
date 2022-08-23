<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setabsen;

class SetabsenController extends Controller
{
    public function index(Request $request)
    {
        $data = Setabsen::first();
        return view('amdk/setabsen.index',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Setabsen::find($id);
        $data->update($request->all());
        return redirect('/amdk/setabsen')->with('sukses','Data Diperbaharui');
    }

}
