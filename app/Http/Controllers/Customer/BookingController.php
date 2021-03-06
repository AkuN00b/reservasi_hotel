<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\DynamicData;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {
            $bookings = Booking::where('user_id', Auth::user()->id)
                           ->orderBy('id', 'DESC')->get();

            return view('customer.booking.index', compact('bookings'));
        } else {
            return view('errors.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {
            $bookings = Booking::find($id);
            return view('customer.booking.detail', compact('bookings'));
        } else {
            return view('errors.401');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {
            $bookings = Booking::find($id);
            return view('customer.booking.edit', compact('bookings'));
        } else {
            return view('errors.401');
        }
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
        if (Auth::user()->status == 1 && Auth::user()->req_status == 1)
        {
            $this->validate($request,[
                'image' => 'mimes:jpeg,bmp,png,jpg',
            ]);
    
            $image = $request->file('image');
            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    
                if(!Storage::disk('public')->exists('proof-transaction'))
                {
                    Storage::disk('public')->makeDirectory('proof-transaction');
                }
                $bookings = Image::make($image)->stream();
                Storage::disk('public')->put('proof-transaction/'.$imagename,$bookings);
            } else {
                $imagename = "default.png";
            }
    
            $bookings = Booking::find($id);
            $bookings->image = $imagename;
            $bookings->save();
    
            Toastr::success('Proof Transaction Successfully Uploaded :))', 'Success');
    
            return redirect()->route('customer.booking.show', $id);
        } else {
            return view('errors.401');
        }
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
