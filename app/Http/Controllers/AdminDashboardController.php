<?php

namespace App\Http\Controllers;

use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\UserLog;
use Illuminate\Support\Facades\Auth;
use App\Seeker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        UserLog::insert(['user_id' => Auth::guard('web')->user()->id, 'type' => 1, 'created_at' => Carbon::now()->format('Y-m-d')]);
        $regular = RegularListing::count();
        $quick = QuickListing::count();
        $providers = Provider::count();
        $seekers = Seeker::count();

        $data_count = array(
            'jobs' => ($regular + $quick),
            'providers' => $providers,
            'seekers' => $seekers,
            'users' => ($seekers + $providers)
        );

        return view('admin.dashboard', compact('data_count'));
    }
}
