<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickListing extends Model
{
    protected $appends = [
        'created_date'
    ];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
