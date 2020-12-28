<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "room";
    protected $fillable = [
        'class_id', 'bed_id', 'price', 'user_id', 'room_id', 'slug', 'status',
    ];

    public function class()
    {
        return $this->belongsTo('App\Classs');
    }

    public function bed()
    {
        return $this->belongsTo('App\Bed');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

    public function roomNumber()
    {
        return $this->hasMany('App\RoomNumber')->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
