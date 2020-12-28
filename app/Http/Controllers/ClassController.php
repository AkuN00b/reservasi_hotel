<?php

namespace App\Http\Controllers;

use App\Bed;
use App\Room;
use App\Classs;
use App\DynamicData;
use App\RoomNumber;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function details($id, $slug)
    {
        $class = Classs::where('slug', $slug)->where('id', $id)->where('status', 1)->first();
        $rooms = Room::where('class_id', $id)->where('status', 1)->get();

        $classs = Classs::where('status', 1)->get();

        $dynamicdatas1 = DynamicData::where('section', 'Address')->get();
        $dynamicdatas2 = DynamicData::where('section', 'Reservation')->get();

        return view('detail', compact('class', 'rooms', 'classs', 'dynamicdatas1', 'dynamicdatas2'));
    }

    public function buypage($id, $class_id, $bed_id, $class_slug, $bed_slug)
    {
        $rooms = Room::where('bed_id', $bed_id)->where('class_id', $class_id)->where('id', $id)->where('status', 1)->first();
        $classes = Classs::where('slug', $class_slug)->where('id', $class_id)->where('status', 1)->first();
        $beds = Bed::where('slug', $bed_slug)->where('id', $bed_id)->where('status', 1)->first();
        $roomnumber = RoomNumber::where('room_id', $id)
                                ->where('status', 1)->get();

        $classs = Classs::where('status', 1)->get();
        
        $dynamicdatas1 = DynamicData::where('section', 'Address')->get();
        $dynamicdatas2 = DynamicData::where('section', 'Reservation')->get();

        return view('buypage', compact('rooms', 'roomnumber', 'classes', 'beds', 'classs', 'dynamicdatas1', 'dynamicdatas2'));
    }
}
