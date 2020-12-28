<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = Bed::where('status', 1)->get();

        return view('receptionist.bed.index', compact('beds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receptionist.bed.create');
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
            'name' => 'required',
            'person' => 'required'
        ]);

        $bed = new Bed();
        $bed->name = $request->name;
        $bed->slug = str_slug($request->name);
        $bed->person = $request->person;
        $bed->user_id = Auth::user()->id;
        $bed->status = 0;
        $bed->save();

        Toastr::success('Bed Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.bed.request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bed = Bed::find($id);
        return view('receptionist.bed.detail', compact('bed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bed = Bed::find($id);
        return view('receptionist.bed.edit', compact('bed'));
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
            'person' => 'required',
            'bed_id' => 'required',
        ]);

        $bed = new Bed();
        $bed->name = $request->name;
        $bed->slug = str_slug($request->name);
        $bed->person = $request->person;
        $bed->user_id = Auth::user()->id;
        $bed->bed_id = $request->bed_id;
        $bed->status = 0;
        $bed->save();

        Toastr::success('Bed Category Successfully Requested :))', 'Success');

        return redirect()->route('receptionist.bed.request');
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
