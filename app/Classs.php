<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    protected $table = "class";
    protected $fillable = [
        'name', 'slug', 'desc', 'image', 'user_id', 'user_image_id', 'class_id', 'status',
    ];

    public function room()
    {
        return $this->hasMany('App\Room');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_image()
    {
        return $this->belongsTo('App\User');
    }
}
