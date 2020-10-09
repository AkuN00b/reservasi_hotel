<?php

namespace App\Http\Controllers;

use App\Bed;
use App\Room;
use App\Classs;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function details($id, $slug)
    {
        $class = Classs::where('slug', $slug)->where('id', $id)->first();
        $rooms = Room::where('class_id', $id)->get();

        return view('detail', compact('class', 'rooms'));
    }

    public function buypage($id, $class_id, $bed_id, $class_slug, $bed_slug)
    {
        $rooms = Room::where('bed_id', $bed_id)->where('class_id', $class_id)->where('id', $id)->first();
        $classes = Classs::where('slug', $class_slug)->where('id', $class_id)->first();
        $beds = Bed::where('slug', $bed_slug)->where('id', $bed_id)->first();

        return view('buypage', compact('rooms', 'classes', 'beds'));
    }
}
