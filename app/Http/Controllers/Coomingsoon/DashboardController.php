<?php

namespace App\Http\Controllers\Coomingsoon;


use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
    public function index()
    {
        return view('coomingsoon/dashboard.index');
    }

   
}
