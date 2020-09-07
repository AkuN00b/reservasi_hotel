<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "room";
    protected $fillable = [
        'class_id', 'bed_id', 'price',
    ];

    public function class()
    {
        return $this->belongsTo('App\Classs');
    }

    public function bed()
    {
        return $this->belongsTo('App\Bed');
    }
}
