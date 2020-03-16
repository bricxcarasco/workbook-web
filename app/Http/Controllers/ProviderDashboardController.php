<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use App\UserLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        UserLog::insert(['user_id' => Auth::guard('web')->user()->id, 'type' => 2, 'created_at' => Carbon::now()->format('Y-m-d')]);
        $announcements = Announcement::where('is_delete', 0)->whereIn('target',[1, 3])->orderBy('created_at', 'DESC')->get();
        return view('provider.dashboard', compact('announcements'));
    }
}
