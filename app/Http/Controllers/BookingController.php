<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function add(Request $request)
    {   
        $this->validate( 
        $request, [
            'user_id' => 'required',
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'identitas' => 'required',
            'no_identitas' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'bed_id' => 'required',
            'class_id' => 'required',
            'room_id' => 'required',
            'status' => 'required'
        ]);

        Booking::create(
        [
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'identitas' => $request->identitas,
            'no_identitas' => $request->no_identitas,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'bed_id' => $request->bed_id,
            'class_id' => $request->class_id,
            'room_id' => $request->room_id,
            'status' => $request->status,
        ]);

        Toastr::success('Booking Data Successfully Saved :))', 'Success');

        return redirect()->route('primary');
    }
}
