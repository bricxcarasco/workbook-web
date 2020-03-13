<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderPagesController extends Controller
{
    public function jobListing()
    {
        return view('provider.job-listing');
    }

    public function myProfile()
    {
        return view('provider.my-profile');
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
