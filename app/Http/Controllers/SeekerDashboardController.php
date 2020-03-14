<?php

namespace App\Http\Controllers;

use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeekerDashboardController extends Controller
{
    public function index()
    {
        $regulars = RegularListing::where('regular_listings.is_delete', 0)
            ->where('regular_listings.status', 0)
            ->leftJoin('providers', 'regular_listings.user_id', '=', 'providers.id')
            ->select('regular_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address')
            ->get();
        
        $quicks = QuickListing::where('quick_listings.is_delete', 0)
            ->where('quick_listings.status', 0)
            ->leftJoin('providers', 'quick_listings.user_id', '=', 'providers.id')
            ->leftJoin('work_classes', 'quick_listings.tag', '=', 'work_classes.id')
            ->select('quick_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address','work_classes.title', 'work_classes.description')
            ->get();

        $providers = Provider::where('is_delete', 0)->get();
        $user = Auth::guard('web')->user();
        $seeker = Seeker::where('user_id', $user->id)->first();
        return view('seeker.dashboard', compact('regulars','quicks','providers','user','seeker'));
    }
}
