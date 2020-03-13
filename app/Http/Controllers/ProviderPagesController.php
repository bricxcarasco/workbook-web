<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderPagesController extends Controller
{
    public function jobListing()
    {
        return view('provider.job-listing');
    }

    public function myProfile()
    {
        $userId = Auth::guard('web')->user()->id;
        $provider = Provider::where('user_id', $userId)->first();
        return view('provider.my-profile', compact('provider'));
    }

    public function mySchedule()
    {
        return view('provider.my-schedule');
    }

    public function newJobListing()
    {
        return view('provider.new-job-listing');
    }

    public function postJob()
    {
        return view('provider.post-job');
    }
    
    public function quickJobRequest()
    {
        return view('provider.quick-job-request');
    }

    public function viewApplications()
    {
        return view('provider.view-applications');
    }
    
}
