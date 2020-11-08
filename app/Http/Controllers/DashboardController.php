<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use App\Classs;
use App\Room;
use Brian2694\Toastr\Facades\Toastr;
use App\DynamicData;

class DashboardController extends Controller
{
    public function index()
    {   
        $class = Classs::all();
        $classs = Classs::all();
        $dynamicdatas1 = DynamicData::where('section', 'Address')->get();
        $dynamicdatas2 = DynamicData::where('section', 'Reservation')->get();

        return view('welcome', compact('class', 'classs', 'dynamicdatas1', 'dynamicdatas2'));
    }
}
