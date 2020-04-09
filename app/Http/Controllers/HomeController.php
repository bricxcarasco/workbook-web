<?php

namespace App\Http\Controllers;

use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use App\UserLog;
use App\WorkClass;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcomePage()
    {
        $regular = RegularListing::count();
        $quick = QuickListing::count();
        $providers = UserLog::where('type', 2)->count();
        $seekers = UserLog::where('type', 3)->count();
        $providerCount = Provider::count();
        $seekerCount = Seeker::count();

        $categories = WorkClass::pluck('title');

        $data_count = array(
            'jobs' => ($regular + $quick),
            'providers' => $providerCount,
            'seekers' => $seekerCount,
            'users' => ($seekers + $providers)
        );

        return view('welcome', compact('data_count', 'categories'));
    }
}
