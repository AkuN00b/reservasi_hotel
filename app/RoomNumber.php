<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    protected $table = "room_number";
    protected $filled = [
        'name', 'room_id', 'status', 'user_id', 'room_number_id', 'req_status',
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function room_number()
    {
        return $this->belongsTo('App\RoomNumber');
    }
}
