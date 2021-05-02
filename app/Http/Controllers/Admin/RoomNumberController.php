<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.roomnumber.index', compact('roomnumbers'));
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

        return view('admin.roomnumber.create', compact('rooms'));
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
            'status' => 'required',
        ]);

        $roomnumber = new RoomNumber();
        $roomnumber->name = $request->name;
        $roomnumber->room_id = $request->room_id;
        $roomnumber->status = $request->status;
        $roomnumber->user_id = Auth::user()->id;
        $roomnumber->req_status = 1;
        $roomnumber->save();

        Toastr::success('Room Number Category Successfully Saved :))', 'Success');

        return redirect()->route('admin.room-number.index');
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
        return view('admin.roomnumber.detail', compact('roomnumber'));
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

        return view('admin.roomnumber.edit', compact('rooms', 'roomnumber'));
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
        $this->validate($request, [
            'name' => 'required',
            'room_id' => 'required',
            'status' => 'required',
        ]);

        $roomnumber = RoomNumber::find($id);
        $roomnumber->name = $request->name;
        $roomnumber->room_id = $request->room_id;
        $roomnumber->status = $request->status;
        $roomnumber->user_id = Auth::user()->id;
        $roomnumber->save();

        Toastr::success('Room Number Category Successfully Updated :))', 'Success');

        return redirect()->route('admin.room-number.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomNumber::find($id)->delete();

        Toastr::success('Room Number Category Successfully Deleted :))', 'Success');
        return redirect()->back();
    }
}
