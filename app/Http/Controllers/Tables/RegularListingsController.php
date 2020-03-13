<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RegularListing;

class RegularListingsController extends Controller
{
    public function getJobListingAll()
    {
        return RegularListing::where('is_delete', 0)->get();
    }
}
