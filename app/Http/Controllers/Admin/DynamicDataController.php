<?php

namespace App\Http\Controllers\Admin;

use App\DynamicData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class DynamicDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dynamicdatas = DynamicData::all();

        return view('admin.dynamicdata.index', compact('dynamicdatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dynamicdata.create');
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
            'value' => 'required',
            'section' => 'required',
        ]);

        $dynamicData = new DynamicData();
        $dynamicData->value = $request->value;
        $dynamicData->section = $request->section;
        $dynamicData->save();

        Toastr::success('Dynamic Data Successfully Saved :))', 'Success');

        return redirect()->route('admin.dynamic-data.index');
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
        $dynamicData = DynamicData::find($id);
        
        return view('admin.dynamicdata.edit', compact('dynamicData'));
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
            'value' => 'required',
            'section' => 'required',
        ]);

        $dynamicData = DynamicData::find($id);
        $dynamicData->value = $request->value;
        $dynamicData->section = $request->section;
        $dynamicData->save();

        Toastr::success('Dynamic Data Successfully Updated :))', 'Success');

        return redirect()->route('admin.dynamic-data.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DynamicData::find($id)->delete();

        Toastr::success('Dynamic Data Successfully Deleted :))', 'Success');
        return redirect()->back();
    }
}
