<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Bed;
use App\Classs;
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
        return view('admin.room.index', compact('rooms'));
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
        return view('admin.room.create', compact('beds', 'class'));
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
        $room->status = 1;
        $room->save();

        Toastr::success('Room Category Successfully Saved :))', 'Success');

        return redirect()->route('admin.room.index');
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
        return view('admin.room.detail', compact('room'));
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
        return view('admin.room.edit', compact('room', 'class', 'beds'));
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
            'price' => 'required'
        ]);

        $room = Room::find($id);
        $room->class_id = $request->class_id;
        $room->bed_id = $request->bed_id;
        $room->price = $request->price;
        $room->user_id = Auth::user()->id;
        $room->save();

        Toastr::success('Room Category Successfully Updated :))', 'Success');

        return redirect()->route('admin.room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::find($id)->delete();

        Toastr::success('Room Category Successfully Deleted :))', 'Success');
        return redirect()->back();
    }
}