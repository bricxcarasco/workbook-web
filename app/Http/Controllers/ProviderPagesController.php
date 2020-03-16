<?php

namespace App\Http\Controllers;

use App\Application;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\WorkClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProviderPagesController extends Controller
{
    public function jobListing()
    {
        $user_id = Auth::guard('web')->user()->id;
        $listings = RegularListing::where('is_delete', 0)->where('user_id', $user_id)->get();
        return view('provider.job-listing', compact('listings'));
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
        $categories = WorkClass::where('is_delete', 0)->select('id', 'title')->get();
        return view('provider.post-job', compact('categories'));
    }
    
    public function quickJobRequest()
    {
        $categories = WorkClass::where('is_delete', 0)->get();
        return view('provider.quick-job-request', compact('categories'));
    }

    public function quickJobRequestAdd(Request $request, $id)
    {
        $category = WorkClass::find($id);
        return view('provider.quick-job-request-add', compact('category'));
    }

    public function viewApplications()
    {
        $userId = Auth::guard('web')->user()->id;
        $provider = Provider::where('user_id', $userId)->first();

        $app_listings = Application::where('applications.type', 1)
            ->leftJoin('regular_listings', 'applications.job_id', '=', 'regular_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->where('regular_listings.user_id', $userId)
            ->select('regular_listings.*','applications.*', 'seekers.full_name', 'seekers.gender', 'seekers.address', 'seekers.id as employee_id', 'seekers.civil_status', 'seekers.telephone_number', 'seekers.mobile_number', 'seekers.high_school', 'seekers.high_school_year', 'seekers.college', 'seekers.college_year', 'seekers.image as e_image')
            ->orderBy('applications.created_at', 'ASC')
            ->get();

        $app_quicks = Application::where('applications.type', 2)
            ->leftJoin('quick_listings', 'applications.job_id', '=', 'quick_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->where('quick_listings.user_id', $userId)
            ->select('quick_listings.*','applications.*', 'seekers.full_name', 'seekers.gender', 'seekers.address', 'seekers.id as employee_id', 'seekers.civil_status', 'seekers.telephone_number', 'seekers.mobile_number', 'seekers.high_school', 'seekers.high_school_year', 'seekers.college', 'seekers.college_year', 'seekers.image as e_image')
            ->orderBy('applications.created_at', 'ASC')
            ->get();

        return view('provider.view-applications', compact('app_listings', 'app_quicks', 'provider'));
    }

    public function quickJobListing()
    {
        $user_id = Auth::guard('web')->user()->id;

        $quick_jobs = DB::table('quick_listings')
            ->leftJoin('work_classes', 'quick_listings.tag', '=', 'work_classes.id')
            ->select('quick_listings.*', 'work_classes.title', 'work_classes.description', 'work_classes.image')
            ->where('quick_listings.is_delete', 0)
            ->where('quick_listings.user_id', $user_id)
            ->get();

        return view('provider.quick-job-list', compact('quick_jobs'));
    }

    public function jobListingSingle(Request $request, $id)
    {
        $listing = RegularListing::find($id);
        return view('provider.post-job-view', compact('listing'));
    }
    
}
