<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use Brian2694\Toastr\Facades\Toastr;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = Bed::all();
        return view('admin.bed.index', compact('beds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bed.create');
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
        $bed->save();

        Toastr::success('Bed Category Successfully Saved :))', 'Success');

        return redirect()->route('admin.bed.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.bed.edit', compact('bed'));
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
        $bed = Bed::find($id);
        $bed->name = $request->name;
        $bed->slug = str_slug($request->name);
        $bed->person = $request->person;
        $bed->save();

        Toastr::success('Bed Category Successfully Updated :))', 'Success');
        
        return redirect()->route('admin.bed.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bed::find($id)->delete();

        Toastr::success('Bed Category Successfully Deleted :))', 'Success');
        return redirect()->back();
    }
}
