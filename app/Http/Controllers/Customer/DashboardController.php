<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Booking;

class DashboardController extends Controller
{
    public function index()
    {   
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {   
            $booking = Booking::where('user_id', Auth::user()->id)->get();
            $booking_accept = Booking::where('user_id', Auth::user()->id)->where('status', 4)->get();
            $booking_refuse = Booking::where('user_id', Auth::user()->id)->where('status', 2)->get();
            $booking_ongoing = Booking::where('user_id', Auth::user()->id)
                                      ->where('status', 1)
                                      ->orwhere('status', 0)
                                      ->orwhere('status', 3)->get();

            return view('customer.dashboard', compact('booking', 'booking_accept', 'booking_refuse', 'booking_ongoing'));
        } else {
            auth()->logout();

            Toastr::error('Your Account is In-Active contact Reservasi-Hotel Administrator', 'Error');
            return redirect('/');
        }
    }
}
