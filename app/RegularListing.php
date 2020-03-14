<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegularListing extends Model
{
    protected $appends = [
        'created_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
