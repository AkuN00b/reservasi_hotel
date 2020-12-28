<?php

namespace App\Http\Controllers\Receptionist;

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
        $class_request = Classs::where('user_image_id', Auth::user()->id)
                          ->where('status', 0)
                          ->orderBy('id', 'DESC')->get();

        $classes = Classs::where('user_image_id', Auth::user()->id)
                  ->where('status', 1)->get();

        $class_accepted = Classs::where('user_image_id', Auth::user()->id)
                           ->where('status', 2)
                           ->orderBy('id', 'DESC')->get();

        $class_canceled = Classs::where('user_image_id', Auth::user()->id)
                           ->where('status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.class.image.index', compact('classes', 'class_request', 'class_accepted', 'class_canceled'));
    }

    public function edit($id)
    {
        $class = Classs::find($id);
        return view('receptionist.class.image.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = Classs::find($id);

        $this->validate($request, [
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        $image = $request->file('image');
        $slug = str_slug($class->name);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('class'))
            {
                Storage::disk('public')->makeDirectory('class');
            }
            $class = Image::make($image)->resize(255,174)->stream();
            Storage::disk('public')->put('class/'.$imagename,$class);

            if(!Storage::disk('public')->exists('class/request'))
            {
                Storage::disk('public')->makeDirectory('class/request');
            }
            $class = Image::make($image)->resize(255,174)->stream();
            Storage::disk('public')->put('class/request/'.$imagename,$class);
        } else {
            $imagename = "default.png";
        }

        $classs = Classs::find($id);

        $class = new Classs();
        $class->name = $classs->name;
        $class->slug = 99;
        $class->desc = $classs->desc;
        $class->image = $imagename;
        $class->user_image_id = Auth::user()->id;
        $class->class_id = $id;
        $class->status = 0;
        $class->save();

        Toastr::success('Class Image Successfully Requested :))', 'Success');
        return redirect()->route('receptionist.class.image-request');
    }
}
