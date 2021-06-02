<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;

class CarouselController extends Controller
{
    public function index()
    {
        $data = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
                
        // return view('layouts.portal',compact('data'));
        return view('carousel.index',compact('data'));
    }
}
