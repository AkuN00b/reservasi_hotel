<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $table = "bed";
    protected $fillable = [
        'name', 'slug', 'person', 'user_id', 'bed_id', 'status',
    ];

    public function room()
    {
        return $this->hasMany('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
