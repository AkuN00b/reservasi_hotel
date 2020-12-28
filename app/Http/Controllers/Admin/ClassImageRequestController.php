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

class ClassImageRequestController extends Controller
{
    public function index()
    {
        $classes = Classs::where('status', 0)
                         ->whereNotNull('user_image_id')->get();

        $class_active = Classs::where('status', 1)
                              ->whereNotNull('user_image_id')->get();

        $class_accepted = Classs::where('status', 2)
                                ->orderBy('id', 'DESC')
                                ->whereNotNull('user_image_id')->get();

        $class_canceled = Classs::where('status', 9)
                                ->orderBy('id', 'DESC')
                                ->whereNotNull('user_image_id')->get();

        return view('admin.class.image.index', compact('classes', 'class_active', 'class_accepted', 'class_canceled'));
    }

    public function approve($id)
    {
        $class = Classs::find($id);

        $classs = $class->class_id;
        $class_id = Classs::find($classs);

        if ($class->status != 2)
        {
            if(Storage::disk('public')->exists('class/'.$class_id->image))
            {
                Storage::disk('public')->delete('class/'.$class_id->image);
            }

            $class_id->image = $class->image;
            $class_id->user_image_id = $class->user_image_id;
            $class_id->save();

            $class->status = 2;
            $class->save();
    
            Toastr::success('Class Image Request Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('Class Image Request has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function reject($id)
    {
        $class = Classs::find($id);

        if ($class->status != 9)
        {   
            if(Storage::disk('public')->exists('class/'.$class->image))
            {
                Storage::disk('public')->delete('class/'.$class->image);
            }

            $class->status = 9;
            $class->save();

            Toastr::success('Class Image Request Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('Class Image Request has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}
