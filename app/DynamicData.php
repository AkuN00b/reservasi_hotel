<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicData extends Model
{
    protected $table = "dynamic_data";
    protected $filled = [
        'value', 'section',
    ];
}
