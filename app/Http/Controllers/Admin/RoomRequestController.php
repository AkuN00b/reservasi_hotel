<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Brian2694\Toastr\Facades\Toastr;

class RoomRequestController extends Controller
{
    public function index()
    {
        $rooms = Room::where('status', 0)->get();

        $room_active = Room::where('status', 1)->get();

        $room_accepted = Room::where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $room_canceled = Room::where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('admin.room.index', compact('rooms', 'room_active', 'room_accepted', 'room_canceled'));
    }

    public function create(Request $request, $id)
    {
        $room = Room::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($room->status != 1)
        {   
            $room->status = 1;
            $room->save();

            $roomm = new Room();
            $roomm->class_id = $room->class_id;
            $roomm->bed_id = $room->bed_id;
            $roomm->price = $room->price;
            $roomm->user_id = $room->user_id;
            $roomm->room_id = $id;
            $roomm->slug = $request->slug;
            $roomm->status = 2;
            $roomm->save();

            Toastr::success('Room Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $room = Room::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $roomm = $room->room_id;
        $room_id = Room::find($roomm);

        if ($room->status != 2)
        {
            $room_id->class_id = $room->class_id;
            $room_id->bed_id = $room->bed_id;
            $room_id->price = $room->price;
            $room_id->user_id = $room->user_id;
            $room_id->save();

            $room->slug = $request->slug;
            $room->status = 2;
            $room->save();
    
            Toastr::success('Room Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $room = Room::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $roomm = $room->room_id;
        $room_id = Room::find($roomm);

        if ($room->status != 2)
        {
            $room->slug = $request->slug;
            $room->status = 2;
            $room->save();

            $room_id->delete();

            Toastr::success('Room Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function cancel(Request $request, $id)
    {
        $room = Room::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($room->status != 9)
        {   
            $room->slug = $request->slug;
            $room->status = 9;
            $room->save();

            Toastr::success('Room Category Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('Room Category has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}
