<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classs;
use Brian2694\Toastr\Facades\Toastr;
use App\DynamicData;

class DashboardController extends Controller
{
    public function index()
    {   
        $class = Classs::where('status', 1)->get();
        $classs = Classs::where('status', 1)->get();
        $dynamicdatas1 = DynamicData::where('section', 'Address')->get();
        $dynamicdatas2 = DynamicData::where('section', 'Reservation')->get();

        return view('welcome', compact('class', 'classs', 'dynamicdatas1', 'dynamicdatas2'));
    }
}
