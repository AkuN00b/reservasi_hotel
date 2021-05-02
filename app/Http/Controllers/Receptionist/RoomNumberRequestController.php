<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomNumber;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class RoomNumberRequestController extends Controller
{
    public function request()
    {
        $roomnumber_request = RoomNumber::where('user_id', Auth::user()->id)
                          ->where('req_status', 0)
                          ->orderBy('id', 'DESC')->get();

        $roomnumbers = RoomNumber::where('user_id', Auth::user()->id)
                  ->where('req_status', 1)->get();

        $roomnumber_accepted = RoomNumber::where('user_id', Auth::user()->id)
                           ->where('req_status', 2)
                           ->orderBy('id', 'DESC')->get();

        $roomnumber_canceled = RoomNumber::where('user_id', Auth::user()->id)
                           ->where('req_status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.roomnumber.index', compact('roomnumbers', 'roomnumber_request', 'roomnumber_accepted', 'roomnumber_canceled'));
    }

    public function toNonActive($id)
    {
        $rm = RoomNumber::find($id);

        if ($rm->status != 9)
        {   
            if ($rm->status == 0)
            {
                Toastr::error('Room Number has Booked, No Editing until Check Out :))', 'Error');
            } else {
                $rm->status = 9;
                $rm->save();

                Toastr::success('Room Number Successfully to Non Active :))', 'Success');
            }    
        } else {
            Toastr::error('Room Number has Already to Non Active :))', 'Error');
        }

        return redirect()->back();
    }

    public function toActive($id)
    {
        $rm = RoomNumber::find($id);

        if ($rm->status != 1)
        {   
            if ($rm->status == 0)
            {
                Toastr::error('Room Number has Booked. No Editing until Check Out :))', 'Error');
            } else {
                $rm->status = 1;
                $rm->save();

                Toastr::success('Room Number Successfully to Active :))', 'Success');
            }
        } else {
            Toastr::error('Room Number has Already to Active :))', 'Error');
        }

        return redirect()->back();
    }
}
