<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    protected $fillable = [
        'user_id',
            'full_name',
            'gender',
            'email_address'
    ];
}
