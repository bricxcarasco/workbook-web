<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Application;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use Illuminate\Http\Request;
use App\Seeker;
use App\User;
use App\UserLog;
use App\WorkClass;
use Carbon\Carbon;

class AdminPagesController extends Controller
{
    public function employmentRate() {

        $app_listings = Application::where('applications.type', 1)
            ->leftJoin('regular_listings', 'applications.job_id', '=', 'regular_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->leftJoin('users', 'regular_listings.user_id', '=', 'users.id')
            ->leftJoin('providers', 'users.id', '=', 'providers.user_id')
            ->select('applications.*', 'seekers.full_name', 'seekers.id as employee_id', 'providers.business_name', 'providers.id as provider_id', 'regular_listings.id as temp_job_id')
            ->orderBy('applications.created_at', 'DESC')
            ->get();

        $app_quicks = Application::where('applications.type', 2)
            ->leftJoin('quick_listings', 'applications.job_id', '=', 'quick_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->leftJoin('users', 'quick_listings.user_id', '=', 'users.id')
            ->leftJoin('providers', 'users.id', '=', 'providers.user_id')
            ->select('applications.*', 'seekers.full_name', 'seekers.id as employee_id', 'providers.business_name', 'providers.id as provider_id', 'quick_listings.id as temp_job_id')
            ->orderBy('applications.created_at', 'DESC')
            ->get();

        $total_counts = [
            Application::where('status', 1)->count(),
            Application::where('status', 2)->count(),
            Application::where('status', 3)->count(),
            Application::where('status', 4)->count(),
            Application::where('status', 5)->count(),
            Application::where('status', 6)->count(),
            Application::whereNotIn('status', [1,2,3,4,5,6])->count(),
        ];

        $rawEmployments = collect($app_listings->merge($app_quicks))->sortBy('event_date');
        $employments = $rawEmployments->values()->all();

        return view('admin.employment-rate', compact('employments','total_counts'));
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
        $announcements = Announcement::where('is_delete', 0)->get();
        return view('admin.manage-announcements', compact('announcements'));
    }

    public function manageListings() {
        $work_classes = WorkClass::where('is_delete', 0)->get();
        return view('admin.manage-listings', compact('work_classes'));
    }

    public function myEvents() {
        return view('admin.my-events');
    }

    public function recentListings() {
        return view('admin.recent-listings');
    }

    public function userActivity() {
        $regular = RegularListing::count();
        $quick = QuickListing::count();
        $providers = UserLog::where('type', 2)->count();
        $seekers = UserLog::where('type', 3)->count();

        $data_count = array(
            'jobs' => ($regular + $quick),
            'providers' => $providers,
            'seekers' => $seekers,
            'users' => ($seekers + $providers)
        );

        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now()->format('Y-m-d');
        $all_dates = [];
        $providers = [];
        $seekers = [];
        while ($startDate->lte($endDate)){
            $all_dates[] = $startDate->toDateString();
            $startDate->addDay();
        }

        foreach ($all_dates as $date) {
            array_push($providers, UserLog::where('type', 2)->where('created_at', $date)->count());
            array_push($seekers, UserLog::where('type', 3)->where('created_at', $date)->count());
        }

        $total = array_sum($providers) + array_sum($seekers);

        return view('admin.user-activity', compact('data_count', 'providers', 'seekers', 'all_dates', 'total'));
    }

    public function websiteAdministrators() {
        $administrators = User::where('type', 1)->where('is_delete', 0)->get();
        return view('admin.website-administrators', compact('administrators'));
    }
}
