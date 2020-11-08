<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    protected $table = "class";
    protected $fillable = [
        'name',
    ];

    public function room()
    {
        return $this->hasMany('App\Room');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
}
