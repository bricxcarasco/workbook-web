<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeekerDashboardController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_delete', 0)->whereIn('target',[2, 3])->orderBy('created_at', 'DESC')->get();
        return view('seeker.dashboard', compact('announcements'));
    }
}
