<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Agenda_kategori;

class CalendarController extends Controller
{
    public function index()
    {
        $events  = Agenda::SelectRaw('*,CASE
                                            WHEN agenda_kategori_id IN (1,2) THEN "success"
                                            WHEN agenda_kategori_id = 3 THEN "important"
                                            ELSE "info"
                                        END AS kelas') 
                            ->get();    
        return view('calendars.index',compact('events'));
    }

    public function lihat($id)
    {
        $data = Agenda::where('id',$id)->first();
        return view('calendars.lihat',compact('data'));
    }

    public function getData(Request $request)
    {
        $data = Agenda::SelectRaw('*,CASE WHEN agenda_kategori_id IN (1,2) THEN "success"
                                        WHEN agenda_kategori_id = 3 THEN "important"
                                        ELSE "info"
                                    END AS kelas') 
                        ->get();    
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

}
