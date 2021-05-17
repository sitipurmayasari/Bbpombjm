<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;

class PortalController extends Controller
{
    public function index()
    {
        $data = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
                
        return view('layouts.portal',compact('data'));
    }
}
