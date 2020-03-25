<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Chat;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeekerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();
        UserLog::insert(['user_id' => Auth::guard('web')->user()->id, 'type' => 3, 'created_at' => Carbon::now()->format('Y-m-d')]);
        $announcements = Announcement::where('is_delete', 0)->whereIn('target',[2, 3])->orderBy('created_at', 'DESC')->get();
        return view('seeker.dashboard', compact('announcements', 'chat_counts', 'profile'));
    }
}
