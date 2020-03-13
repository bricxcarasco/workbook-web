<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('seeker.my-profile');
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
