<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $filled = [
        'name', 
        'identitas', 
        'no_identitas', 
        'alamat', 
        'jenis_kelamin', 
        'username', 
        'email', 
        'password', 
        'role_id', 
        'image', 
        'about',
        'status',
        'user_id',
        'users_id',
        'req_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

    public function bed()
    {
        return $this->hasMany('App\Bed');
    }

    public function class()
    {
        return $this->hasMany('App\Classs');
    }

    public function room()
    {
        return $this->hasMany('App\Room');
    }

    public function roomnumber()
    {
        return $this->hasMany('App\RoomNumber');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
