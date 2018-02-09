<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 1;
    const OWNER = 2;
    const MEMBER = 3;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'password', 'isActive', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getStatus()
    {
        return $this->isActive == 1 ? 'Active' : 'Suspend';
    }

    public function getListCity()
    {
        $city = [
            'Denpasar'=>'Denpasar',
            'Badung'=>'Badung',
            'Bangli'=>'Bangli',
            'Buleleng'=>'Buleleng',
            'Gianyar'=>'Gianyar',
            'Jembrana'=>'Jembrana',
            'Karangasem'=>'Karangasem',
            'Klungkung'=>'Klungkung',
            'Tabanan'=>'Tabanan',
        ];

        return $city;
    }
}
