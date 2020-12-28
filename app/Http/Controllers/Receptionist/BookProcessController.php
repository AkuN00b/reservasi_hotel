<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Booking;
use App\RoomNumber;

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

        return view('receptionist.booking.index', compact('bookings'));
    }

    public function roomupdate(Request $request, $id)
    {
        $booking = Booking::find($id);

        $this->validate($request,[
            'room_number_id' => 'required',
        ]);
        
            $booking->room_number_id = $request->room_number_id;
            $booking->save();

            Toastr::success('Room has Booked for this Booking :))', 'Success');

        return redirect()->back();
    }

    public function buying($id, $rmid)
    {
        $booking = Booking::find($id);
        $roomNumber = RoomNumber::find($rmid);

        if ($booking->status != 5)
        {   
            if ($roomNumber->status != 0)
            {
                $roomNumber->status = 0;
                $roomNumber->save();

                $booking->status = 5;
                $booking->save();

                Toastr::success('Booking Successfully Confirmed, wait For Customer Buy It', 'Success');
            } else {
                Toastr::error('The Room Number has already Booked', 'Error');
            }
        } else {
            Toastr::info('This Booking Successfully Confirmed, wait For Customer Buy It', 'Info');
        }

        return redirect()->back();
    }

    public function approval($id)
    {
        $booking = Booking::find($id);

        if ($booking->status != 1)
        {   
            $booking->status = 1;
            $booking->save();

            Toastr::success('Customer Pay Approved :))', 'Success');
        } else {
            Toastr::info('This Booking is already Approved :))', 'Info');
        }

        return redirect()->back();
    }

    public function decline($id, $rmid)
    {
        $booking = Booking::find($id);
        $roomNumber = RoomNumber::find($rmid);

        if ($booking->status != 2)
        {   
            $roomNumber->status = 1;
            $roomNumber->save();

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

    public function checkout($id, $rmid)
    {
        $booking = Booking::find($id);
        $roomNumber = RoomNumber::find($rmid);

        if ($booking->status != 4)
        {   
            $roomNumber->status = 1;
            $roomNumber->save();

            $booking->status = 4;
            $booking->save();

            Toastr::success('Booking Successfully Check Out :))', 'Success');
        } else {
            Toastr::info('This Booking is already Check Out :))', 'Info');
        }

        return redirect()->back();
    }
}
