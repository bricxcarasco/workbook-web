<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seeker;

class AdminPagesController extends Controller
{
    public function employmentRate() {
        return view('admin.employment-rate');
    }

    public function jobProviders() {
        return view('admin.job-providers');
    }

    public function jobSeekers() {
        $seekers = Seeker::get();
        $test = "sds";
        return view('admin.job-seekers', compact('seekers', 'test'));
    }

    public function manageAnnouncements() {
        return view('admin.manage-announcements');
    }

    public function manageListings() {
        return view('admin.manage-listings');
    }

    public function myEvents() {
        return view('admin.my-events');
    }

    public function recentListings() {
        return view('admin.recent-listings');
    }

    public function userActivity() {
        return view('admin.user-activity');
    }

    public function websiteAdministrators() {
        return view('admin.website-administrators');
    }
}
