<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeekerDashboardController extends Controller
{
    public function index()
    {
        return view('seeker.dashboard');
    }
}
