<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classs;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Auth;

class ClassRequestController extends Controller
{
    public function index()
    {
        $classes = Classs::where('status', 0)
                         ->whereNotNull('user_id')->get();

        $class_active = Classs::where('status', 1)
                              ->whereNotNull('user_id')->get();

        $class_accepted = Classs::where('status', 2)
                                ->whereNotNull('user_id')->get();

        $class_canceled = Classs::where('status', 9)
                                ->whereNotNull('user_id')->get();

        return view('admin.class.index', compact('classes', 'class_active', 'class_accepted', 'class_canceled'));
    }

    public function create(Request $request, $id)
    {
        $class = Classs::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($class->status != 1)
        {   
            $class->status = 1;
            $class->save();

            $classs = new Classs();
            $classs->name = $class->name;
            $classs->slug = $request->slug;
            $classs->desc = $class->desc;
            $classs->image = $class->image;
            $classs->user_id = $class->user_id;
            $classs->class_id = $id;
            $classs->status = 2;
            $classs->save();


            Toastr::success('Class Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Class Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $class = Classs::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $classs = $class->class_id;
        $class_id = Classs::find($classs);

        if ($class->status != 2)
        {
            $class_id->name = $class->name;
            $class_id->slug = str_slug($class->name);
            $class_id->desc = $class->desc;
            $class_id->user_id = $class->user_id;
            $class_id->save();

            $class->slug = $request->slug;
            $class->status = 2;
            $class->save();
    
            Toastr::success('Class Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Class Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $class = Classs::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        $classs = $class->class_id;
        $class_id = Classs::find($classs);

        if ($class->status != 2)
        {
            $class->slug = $request->slug;
            $class->status = 2;
            $class->save();

            $class_id->delete();

            Toastr::success('Class Category Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Class Category has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function cancel(Request $request, $id)
    {
        $class = Classs::find($id);

        $this->validate($request, [
            'slug' => 'required',
        ]);

        if ($class->status != 9)
        {   
            if ($class->image == !NULL)
            {
                if(Storage::disk('public')->exists('class/'.$class->image))
                {
                    Storage::disk('public')->delete('class/'.$class->image);
                }
            }
            $class->slug = $request->slug;
            $class->status = 9;
            $class->save();

            Toastr::success('Class Category Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('Class Category has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}
