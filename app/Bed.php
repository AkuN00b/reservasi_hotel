<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $table = "bed";
    protected $fillable = [
        'name', 'person'
    ];

    public function room()
    {
        return $this->hasMany('App\Room');
    }
}
