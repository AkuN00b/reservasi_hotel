<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class BedRequestController extends Controller
{
    public function request()
    {
        $bed_request = Bed::where('user_id', Auth::user()->id)
                          ->where('status', 0)
                          ->orderBy('id', 'DESC')->get();

        $beds = Bed::where('user_id', Auth::user()->id)
                  ->where('status', 1)->get();

        $bed_accepted = Bed::where('user_id', Auth::user()->id)
                           ->where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $bed_canceled = Bed::where('user_id', Auth::user()->id)
                           ->where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.bed.index', compact('beds', 'bed_request', 'bed_accepted', 'bed_canceled'));
    }

    public function reqdelete($id)
    {
        $bedd = Bed::find($id);

        $bed = new Bed();
        $bed->name = $bedd->name;
        $bed->slug = 0;
        $bed->person = $bedd->person;
        $bed->user_id = Auth::user()->id;
        $bed->bed_id = $id;
        $bed->status = 0;
        $bed->save();

        Toastr::success('Bed Category Successfully Requested :))', 'Success');
        return redirect()->back();
    }
}
