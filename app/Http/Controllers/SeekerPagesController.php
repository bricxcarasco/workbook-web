<?php

namespace App\Http\Controllers;

use App\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeekerPagesController extends Controller
{
    public function fullTime()
    {
        return view('seeker.full-time');
    }

    public function myCalendar()
    {
        return view('seeker.my-calendar');
    }

    public function mySchedule()
    {
        return view('seeker.my-schedule');
    }

    public function myProfile()
    {
        $userId = Auth::guard('web')->user()->id;
        $seeker = Seeker::where('user_id', $userId)->first();
        return view('seeker.my-profile', compact('seeker'));
    }

    public function ongoingApplications()
    {
        return view('seeker.ongoing-applications');
    }

    public function partTime()
    {
        return view('seeker.part-time');
    }
}
