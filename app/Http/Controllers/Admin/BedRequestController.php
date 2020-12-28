<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bed;
use Brian2694\Toastr\Facades\Toastr;

class BedRequestController extends Controller
{
    public function index()
    {
        $beds = Bed::where('status', 0)->get();

        $bed_active = Bed::where('status', 1)->get();

        $bed_accepted = Bed::where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $bed_canceled = Bed::where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('admin.bed.index', compact('beds', 'bed_active', 'bed_accepted', 'bed_canceled'));
    }

    public function create(Request $request, $id)
    {
        $bed = Bed::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($bed->status != 1)
        {   
            $bed->status = 1;
            $bed->save();

            $bedd = new Bed();
            $bedd->name = $bed->name;
            $bedd->slug = $request->slug;
            $bedd->person = $bed->person;
            $bedd->user_id = $bed->user_id;
            $bedd->bed_id = $id;
            $bedd->status = 2;
            $bedd->save();


            Toastr::success('Bed Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Bed Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $bed = Bed::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $bedd = $bed->bed_id;
        $bed_id = Bed::find($bedd);

        if ($bed->status != 2)
        {
            $bed_id->name = $bed->name;
            $bed_id->slug = str_slug($bed->name);
            $bed_id->person = $bed->person;
            $bed_id->user_id = $bed->user_id;
            $bed_id->save();

            $bed->slug = $request->slug;
            $bed->status = 2;
            $bed->save();
    
            Toastr::success('Bed Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Bed Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $bed = Bed::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $bedd = $bed->bed_id;
        $bed_id = Bed::find($bedd);

        if ($bed->status != 2)
        {
            $bed->slug = $request->slug;
            $bed->status = 2;
            $bed->save();

            $bed_id->delete();

            Toastr::success('Bed Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Bed Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function cancel(Request $request, $id)
    {
        $bed = Bed::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($bed->status != 9)
        {   
            $bed->slug = $request->slug;
            $bed->status = 9;
            $bed->save();

            Toastr::success('Bed Category Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('Bed Category has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}
