<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Agenda_kategori;

class CalendarController extends Controller
{
    public function index()
    {
        $data = Agenda::all();    
        return view('calendars.index',compact('data'));
    }

    public function lihat($id)
    {
        $data = Agenda::where('id',$id)->first();
        return view('calendars.lihat',compact('data'));
    }
}
