<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomNumber;
use App\Room;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class RoomNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomnumbers = RoomNumber::where('req_status', 1)->get();

        return view('receptionist.roomnumber.index', compact('roomnumbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::where('status', 1)
                     ->orderBy('class_id', 'asc')->get();

        return view('receptionist.roomnumber.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:room_number',
            'room_id' => 'required',
        ]);

        $roomnumber = new RoomNumber();
        $roomnumber->name = $request->name;
        $roomnumber->room_id = $request->room_id;
        $roomnumber->user_id = Auth::user()->id;
        $roomnumber->req_status = 0;
        $roomnumber->save();

        Toastr::success('Room Number Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.room-number.request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomnumber = RoomNumber::find($id);
        return view('receptionist.roomnumber.detail', compact('roomnumber'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = Room::where('status', 1)
                     ->orderBy('class_id', 'asc')->get();
        $roomnumber = RoomNumber::find($id);

        return view('receptionist.roomnumber.edit', compact('rooms', 'roomnumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rm = RoomNumber::find($id);

        if ($rm->name == $request->name)
        {
            $a = '';
        } else {
            $a = '|unique:room_number';
        }

        $this->validate($request, [
            'name' => 'required'.$a.'',
            'room_id' => 'required',
            'status' => 'required',
            'room_number_id' => 'required',
        ]);

        $roomnumber = new RoomNumber();
        $roomnumber->name = $request->name;
        $roomnumber->room_id = $request->room_id;
        $roomnumber->status = $request->status;
        $roomnumber->user_id = Auth::user()->id;
        $roomnumber->room_number_id = $request->room_number_id;
        $roomnumber->req_status = 0;
        $roomnumber->save();

        Toastr::success('Room Number Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.room-number.request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rmm = RoomNumber::find($id);

        $rm = new RoomNumber();
        $rm->name = $rmm->name;
        $rm->room_id = $rmm->room_id;
        $rm->status = 99;
        $rm->user_id = Auth::user()->id;
        $rm->room_number_id = $id;
        $rm->req_status = 0;
        $rm->save();

        Toastr::success('Room Number Category Successfully Requested :))', 'Success');
        return redirect()->back();
    }
}
