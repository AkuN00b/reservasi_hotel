<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "booking";
    protected $fillable = [
        'user_id', 'name', 'bed_id', 'class_id', 'room_id',
    ];

    public function class()
    {
        return $this->belongsTo('App\Classs');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bed()
    {
        return $this->belongsTo('App\Bed');
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
