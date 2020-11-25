<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "booking";
    protected $fillable = [
        'user_id', 'role_id', 'name', 'email', 'identitas', 'no_identitas', 'alamat', 'jenis_kelamin', 'tgl_awal', 'tgl_akhir', 'bed_id', 'class_id', 'room_id', 'image', 'status',
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
