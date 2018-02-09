<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
