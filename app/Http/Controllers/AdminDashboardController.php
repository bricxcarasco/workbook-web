<?php

namespace App\Http\Controllers;

use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
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
