<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use App\Classs;
use App\Room;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::where('status', 1)->get();

        return view('receptionist.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beds = Bed::where('status', 1)->get();
        $class = Classs::where('status', 1)->get();
        return view('receptionist.room.create', compact('beds', 'class'));
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
            'class_id' => 'required',
            'bed_id' => 'required',
            'price' => 'required',
        ]);

        $room = new Room();
        $room->class_id = $request->class_id;
        $room->bed_id = $request->bed_id;
        $room->price = $request->price;
        $room->user_id = Auth::user()->id;
        $room->status = 0;
        $room->save();

        Toastr::success('Room Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.room.request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        return view('receptionist.room.detail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $class = Classs::where('status', 1)->get();
        $beds = Bed::where('status', 1)->get();
        return view('receptionist.room.edit', compact('room', 'class', 'beds'));
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
            'class_id' => 'required',
            'bed_id' => 'required',
            'price' => 'required',
            'room_id' => 'required',
            'slug' => 'required',
        ]);

        $room = new Room();
        $room->class_id = $request->class_id;
        $room->bed_id = $request->bed_id;
        $room->price = $request->price;
        $room->user_id = Auth::user()->id;
        $room->room_id = $request->room_id;
        $room->slug = $request->slug;
        $room->status = 0;
        $room->save();

        Toastr::success('Room Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.room.request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
