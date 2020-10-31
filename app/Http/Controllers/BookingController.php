<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BookingController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'bed_id' => 'required',
            'class_id' => 'required',
            'room_id' => 'required',
        ]);

        $booking = new Booking();
        $booking->user_id = $request->user_id;
        $booking->name = $request->name;
        $booking->bed_id = $request->bed_id;
        $booking->class_id = $request->class_id;
        $booking->room_id = $request->room_id;
        $booking->save();

        Toastr::success('Booking Successfully Saved :))', 'Success');

        return redirect()->route('primary');
    }
}
