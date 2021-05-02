<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Bed;
use App\Classs;
use App\Room;
use App\RoomNumber;
use App\User;
use App\Booking;

class DashboardController extends Controller
{
    public function index()
    {   
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {   
            $bed = Bed::where('status', 1)->get();
            $bed_req_active = Bed::where('user_id', Auth::user()->id)->where('status', 1)->get();
            $bed_request = Bed::where('user_id', Auth::user()->id)
                              ->where('status', 0)
                              ->orwhere('status', 2)
                              ->orwhere('status', 9)->get();
            $bed_req_ongoing = Bed::where('user_id', Auth::user()->id)
                                  ->where('status', 0)->get();
            $bed_req_accepted = Bed::where('user_id', Auth::user()->id)
                                   ->where('status', 2)->get();
            $bed_req_canceled = Bed::where('user_id', Auth::user()->id)
                                   ->where('status', 9)->get();

            $class = Classs::where('status', 1)->get();
            $class_req_active = Classs::where('user_id', Auth::user()->id)->where('status', 1)->get();
            $class_request = Classs::where('user_id', Auth::user()->id)
                                   ->where('status', 0)
                                   ->orwhere('status', 2)
                                   ->orwhere('status', 9)->get();
            $class_req_ongoing = Classs::where('user_id', Auth::user()->id)
                                       ->where('status', 0)->get();
            $class_req_accepted = Classs::where('user_id', Auth::user()->id)
                                        ->where('status', 2)->get();
            $class_req_canceled = Classs::where('user_id', Auth::user()->id)
                                        ->where('status', 9)->get();

            $room = Room::where('status', 1)->get();
            $room_req_active = Room::where('user_id', Auth::user()->id)->where('status', 1)->get();
            $room_request = Room::where('user_id', Auth::user()->id)
                                ->where('status', 0)
                                ->orwhere('status', 2)
                                ->orwhere('status', 9)->get();
            $room_req_ongoing = Room::where('user_id', Auth::user()->id)
                                    ->where('status', 0)->get();
            $room_req_accepted = Room::where('user_id', Auth::user()->id)
                                     ->where('status', 2)->get();
            $room_req_canceled = Room::where('user_id', Auth::user()->id)
                                     ->where('status', 9)->get();

            $roomnumber = RoomNumber::where('req_status', 1)->get();
            $roomnumber_req_active = RoomNumber::where('user_id', Auth::user()->id)->where('req_status', 1)->get();
            $roomnumber_request = RoomNumber::where('user_id', Auth::user()->id)
                                ->where('req_status', 0)
                                ->orwhere('req_status', 2)
                                ->orwhere('req_status', 9)->get();
            $roomnumber_req_ongoing = RoomNumber::where('user_id', Auth::user()->id)
                                    ->where('req_status', 0)->get();
            $roomnumber_req_accepted = RoomNumber::where('user_id', Auth::user()->id)
                                     ->where('req_status', 2)->get();
            $roomnumber_req_canceled = RoomNumber::where('user_id', Auth::user()->id)
                                     ->where('req_status', 9)->get();

            $user = User::where('req_status', 1)->get();
            $user_req_active = User::where('user_id', Auth::user()->id)->where('req_status', 1)->get();
            $user_request = User::where('user_id', Auth::user()->id)
                                ->where('req_status', 0)
                                ->orwhere('req_status', 2)
                                ->orwhere('req_status', 9)->get();
            $user_req_ongoing = User::where('user_id', Auth::user()->id)
                                    ->where('req_status', 0)->get();
            $user_req_accepted = User::where('user_id', Auth::user()->id)
                                     ->where('req_status', 2)->get();
            $user_req_canceled = User::where('user_id', Auth::user()->id)
                                     ->where('req_status', 9)->get();

            $booking = Booking::all();
            $booking_req_active = Booking::where('user_id', Auth::user()->id)->get();
            $booking_request = Booking::where('status', 0)
                                      ->orwhere('status', 5)->get();
            $booking_req_ongoing = Booking::where('status', 1)
                                          ->orwhere('status', 3)->get();
            $booking_req_accepted = Booking::where('status', 4)->get();
            $booking_req_canceled = Booking::where('status', 2)->get();

            return view('receptionist.dashboard', compact('bed', 'bed_req_active', 'bed_request', 'bed_req_ongoing', 'bed_req_accepted', 'bed_req_canceled',
                                                          'class', 'class_req_active', 'class_request', 'class_req_ongoing', 'class_req_accepted', 'class_req_canceled',
                                                          'room', 'room_req_active', 'room_request', 'room_req_ongoing', 'room_req_accepted', 'room_req_canceled',
                                                          'roomnumber', 'roomnumber_req_active', 'roomnumber_request', 'roomnumber_req_ongoing', 'roomnumber_req_accepted', 'roomnumber_req_canceled',
                                                          'user', 'user_req_active', 'user_request', 'user_req_ongoing', 'user_req_accepted', 'user_req_canceled',
                                                          'booking', 'booking_req_active', 'booking_request', 'booking_req_ongoing', 'booking_req_accepted', 'booking_req_canceled'));
        } else {
            auth()->logout();

            Toastr::error('Your Account is In-Active contact Reservasi-Hotel Administrator', 'Error');
            return redirect('/');
        }
    }
}
