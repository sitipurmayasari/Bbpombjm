<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Agenda_kategori;

class CalendarController extends Controller
{
    public function index()
    {
        $events  = Agenda::get();    
        return view('calendars.index',compact('events'));
    }

    public function lihat($id)
    {
        $data = Agenda::where('id',$id)->first();
        return view('calendars.lihat',compact('data'));
    }

    public function getData(Request $request)
    {
        $data = Agenda::get();    
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

}
