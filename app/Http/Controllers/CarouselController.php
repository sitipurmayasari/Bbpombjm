<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;

class CarouselController extends Controller
{
    public function index()
    {
        $annc = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
                
        return view('carousel.index',compact('annc'));
    }
}
