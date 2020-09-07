<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    protected $table = "class";
    protected $fillable = [
        'name',
    ];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
