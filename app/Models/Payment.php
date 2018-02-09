<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    const NOT_VERIFIED = 0;
    const VERIFIED = 1;
}
