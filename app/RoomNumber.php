<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    protected $table = "room_number";
    protected $filled = [
        'name', 'room_id', 'status'
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}