<?php

namespace App\Http\Controllers\Receptionist;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class RoomRequestController extends Controller
{
    public function request()
    {
        $room_request = Room::where('user_id', Auth::user()->id)
                          ->where('status', 0)
                          ->orderBy('id', 'DESC')->get();

        $rooms = Room::where('user_id', Auth::user()->id)
                  ->where('status', 1)->get();

        $room_accepted = Room::where('user_id', Auth::user()->id)
                           ->where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $room_canceled = Room::where('user_id', Auth::user()->id)
                           ->where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.room.index', compact('rooms', 'room_request', 'room_accepted', 'room_canceled'));
    }

    public function reqdelete($id)
    {
        $roomm = Room::find($id);

        $room = new Room();
        $room->class_id = $roomm->class_id;
        $room->bed_id = $roomm->bed_id;
        $room->price = $roomm->price;
        $room->user_id = Auth::user()->id;
        $room->room_id = $id;
        $room->slug = 0;
        $room->status = 0;
        $room->save();

        Toastr::success('Room Category Successfully Requested :))', 'Success');
        return redirect()->route('receptionist.room.request');
    }
}
