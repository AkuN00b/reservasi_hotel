<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use App\Classs;
use App\Room;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {   
        $class = Classs::all();
        return view('welcome', compact('class'));
    }
}
