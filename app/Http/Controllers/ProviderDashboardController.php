<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_delete', 0)->whereIn('target',[1, 3])->orderBy('created_at', 'DESC')->get();
        return view('provider.dashboard', compact('announcements'));
    }
}
