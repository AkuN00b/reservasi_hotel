<?php

namespace App\Http\Controllers\Receptionist;

use App\Classs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class ClassRequestController extends Controller
{
    public function request()
    {
        $class_request = Classs::where('user_id', Auth::user()->id)
                          ->where('status', 0)
                          ->orderBy('id', 'DESC')->get();

        $classes = Classs::where('user_id', Auth::user()->id)
                  ->where('status', 1)->get();

        $class_accepted = Classs::where('user_id', Auth::user()->id)
                           ->where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $class_canceled = Classs::where('user_id', Auth::user()->id)
                           ->where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.class.index', compact('classes', 'class_request', 'class_accepted', 'class_canceled'));
    }

    public function reqdelete($id)
    {
        $classs = Classs::find($id);

        $class = new Classs();
        $class->name = $classs->name;
        $class->slug = 0;
        $class->desc = $classs->desc;
        $class->user_id = Auth::user()->id;
        $class->class_id = $id;
        $class->status = 0;
        $class->save();

        Toastr::success('Class Category Successfully Requested :))', 'Success');
        return redirect()->back();
    }
}
