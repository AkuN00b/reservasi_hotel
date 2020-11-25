<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Booking;

class BookProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::where('role_id', 3)
                        //    ->where('status', 0)
                           ->orderBy('id', 'DESC')->get();

        return view('admin.booking.index', compact('bookings'));
    }

    public function approval($id)
    {
        $booking = Booking::find($id);

        if ($booking->status != 1)
        {
            $booking->status = 1;
            $booking->save();

            Toastr::success('Booking Successfully Approved :))', 'Success');
        } else {
            Toastr::info('This Booking is already Approved :))', 'Info');
        }

        return redirect()->back();
    }

    public function decline($id)
    {
        $booking = Booking::find($id);

        if ($booking->status != 2)
        {
            $booking->status = 2;
            $booking->save();

            Toastr::success('Booking Successfully Declined :))', 'Success');
        } else {
            Toastr::info('This Booking is already Declined :))', 'Info');
        }

        return redirect()->back();
    }

    public function checkin($id)
    {
        $booking = Booking::find($id);

        if ($booking->status != 3)
        {
            $booking->status = 3;
            $booking->save();

            Toastr::success('Booking Successfully Check In :))', 'Success');
        } else {
            Toastr::info('This Booking is already Check In :))', 'Info');
        }

        return redirect()->back();
    }

    public function checkout($id)
    {
        $booking = Booking::find($id);

        if ($booking->status != 4)
        {
            $booking->status = 4;
            $booking->save();

            Toastr::success('Booking Successfully Check Out :))', 'Success');
        } else {
            Toastr::info('This Booking is already Check Out :))', 'Info');
        }

        return redirect()->back();
    }
}
