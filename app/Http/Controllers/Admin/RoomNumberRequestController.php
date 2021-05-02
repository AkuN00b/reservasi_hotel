<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomNumber;
use Brian2694\Toastr\Facades\Toastr;

class RoomNumberRequestController extends Controller
{
    public function index()
    {
        $roomnumbers = RoomNumber::where('req_status', 0)->get();

        $roomnumber_active = RoomNumber::where('req_status', 1)->get();

        $roomnumber_accepted = RoomNumber::where('req_status', 2)
                           ->orderBy('id', 'DESC')->get();

        $roomnumber_canceled = RoomNumber::where('req_status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('admin.roomnumber.index', compact('roomnumbers', 'roomnumber_active', 'roomnumber_accepted', 'roomnumber_canceled'));
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

    public function create(Request $request, $id)
    {
        $roomnumber = RoomNumber::find($id);

        $this->validate($request, [
            'status' => 'required',
        ]);

        if ($roomnumber->req_status != 1)
        {   
            $roomnumber->status = 9;
            $roomnumber->req_status = 1;
            $roomnumber->save();

            $roomm = new RoomNumber();
            $roomm->name = $roomnumber->name.'-r';
            $roomm->room_id = $roomnumber->room_id;
            $roomm->status = $request->status;
            $roomm->user_id = $roomnumber->user_id;
            $roomm->room_number_id = $id;
            $roomm->req_status = 2;
            $roomm->save();

            Toastr::success('Room Number Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Number Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $roomnumber = RoomNumber::find($id);

        if ($roomnumber->name == $request->name)
        {
            $a = '';
        } else {
            $a = '|unique:room_number';
        }

        $this->validate($request, [
            'name' => 'required'.$a.'',
            'status' => 'required',
        ]);

        $rmm = $roomnumber->room_number_id;
        $room_number_id = RoomNumber::find($rmm);

        if ($roomnumber->req_status != 2)
        {   
            $room_number_id->name = $request->name;
            $room_number_id->room_id = $roomnumber->room_id;
            $room_number_id->user_id = $roomnumber->user_id;
            $room_number_id->save();

            $roomnumber->name = $roomnumber->name.'-r';
            $roomnumber->status = $request->status;
            $roomnumber->req_status = 2;
            $roomnumber->save();
    
            Toastr::success('Room Number Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Number Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $roomnumber = RoomNumber::find($id);

        $this->validate($request, [
            'status' => 'required',
        ]);

        $rmm = $roomnumber->room_number_id;
        $room_number_id = RoomNumber::find($rmm);

        if ($roomnumber->req_status != 2)
        {
            $roomnumber->name = $roomnumber->name.'-r';
            $roomnumber->status = $request->status;
            $roomnumber->req_status = 2;
            $roomnumber->save();

            $room_number_id->delete();

            Toastr::success('Room Number Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Room Number Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function cancel(Request $request, $id)
    {
        $roomnumber = RoomNumber::find($id);

        $this->validate($request, [
            'status' => 'required',
        ]);

        if ($roomnumber->req_status != 9)
        {   
            $roomnumber->name = $roomnumber->name.'-r';
            $roomnumber->status = $request->status;
            $roomnumber->req_status = 9;
            $roomnumber->save();

            Toastr::success('Room Number Category Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('Room Number Category has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}
