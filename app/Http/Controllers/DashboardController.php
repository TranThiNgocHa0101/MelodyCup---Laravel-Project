<?php

namespace App\Http\Controllers;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Song;

class DashboardController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function learn() 
    {
        return view('user.learn');
    }
   
}

