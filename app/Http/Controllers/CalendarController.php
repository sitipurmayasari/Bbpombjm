<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Agenda_kategori;

class CalendarController extends Controller
{
    public function index()
    {
        $data = Agenda::get();    
        return view('calendars.index',compact('data'));
    }

    public function lihat($id)
    {
        $data = Agenda::where('id',$id)->first();
        return view('calendars.lihat',compact('data'));
    }

    public function getData(Request $request)
    {
        $appointments = Agenda::get();    
        return response()->json([ 'success' => true,'appointments' => $appointments],200);
    }

}
