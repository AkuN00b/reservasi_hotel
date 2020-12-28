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

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classs::where('status', 1)->get();
        return view('admin.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
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
            'desc' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
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
        } else {
            $imagename = "default.png";
        }

        $class = new Classs();
        $class->name = $request->name;
        $class->slug = $slug;
        $class->desc = $request->desc;
        $class->image = $imagename;
        $class->user_id = Auth::user()->id;
        $class->status = 1;
        $class->save();

        Toastr::success('Class Category Successfully Saved :))', 'Success');
        
        return redirect()->route('admin.class.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Classs::find($id);
        return view('admin.class.detail', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classs::find($id);
        return view('admin.class.edit', compact('class'));
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
        $this->validate($request,[
            'name' => 'required',
            'desc' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $class = Classs::find($id);
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('class'))
            {
                Storage::disk('public')->makeDirectory(('class'));
            }

            if(Storage::disk('public')->exists('class/'.$class->image))
            {
                Storage::disk('public')->delete('class/'.$class->image);
            }

            $classImage = Image::make($image)->resize(255,174)->stream();
            Storage::disk('public')->put('class/'.$imagename,$classImage);
        } else {
            $imagename = $class->image;
        }

        $class->name = $request->name;
        $class->slug = $slug;
        $class->desc = $request->desc;
        $class->image = $imagename;
        $class->save();

        Toastr::success('Class Category Successfully Updated :))', 'Success');

        return redirect()->route('admin.class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classs::find($id);

        if(Storage::disk('public')->exists('class/'.$class->image))
        {
            Storage::disk('public')->delete('class/'.$class->image);
        }

        $class->delete();
        Toastr::success('Class Category Successfully Deleted :))', 'Success');
        return redirect()->back();
    }
}
