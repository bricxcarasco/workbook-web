<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Application;
use App\Chat;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use Illuminate\Http\Request;
use App\Seeker;
use App\User;
use App\UserLog;
use App\WorkClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use stdClass;

use function GuzzleHttp\json_encode;

class AdminPagesController extends Controller
{
    public function employmentRate() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }

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

        return view('admin.employment-rate', compact('profile', 'chat_counts', 'chat_list', 'employments','total_counts'));
    }

    public function jobProviders() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        return view('admin.job-providers', compact('profile', 'chat_counts', 'chat_list'));
    }

    public function jobSeekers() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        $seekers = Seeker::get();
        $test = "sds";
        return view('admin.job-seekers', compact('profile', 'chat_counts', 'chat_list', 'seekers', 'test'));
    }

    public function manageAnnouncements() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        $announcements = Announcement::where('is_delete', 0)->get();
        return view('admin.manage-announcements', compact('profile', 'chat_counts', 'chat_list', 'announcements'));
    }

    public function manageListings() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        $work_classes = WorkClass::where('is_delete', 0)->get();
        return view('admin.manage-listings', compact('profile', 'chat_counts', 'chat_list', 'work_classes'));
    }

    public function myEvents() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        return view('admin.my-events', compact('profile', 'chat_counts', 'chat_list'));
    }

    public function recentListings() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        $category_list = WorkClass::where('is_delete', 0)->orderBy('id', 'desc')->get();
        $categories = WorkClass::where('is_delete', 0)->orderBy('id', 'desc')->pluck('title');
        $ids = WorkClass::where('is_delete', 0)->orderBy('id', 'desc')->pluck('id');
        
        $counts = [];
        foreach ($ids as $id) {
            array_push($counts, (QuickListing::where('tag', $id)->count() + RegularListing::where('tags', $id)->count()));
        }

        $total = round(array_sum($counts), -1);

        return view('admin.recent-listings', compact('profile', 'chat_counts', 'chat_list', 'category_list', 'categories', 'counts', 'total'));
    }

    public function userActivity() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
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

        return view('admin.user-activity', compact('profile', 'chat_counts', 'chat_list', 'data_count', 'providers', 'seekers', 'all_dates', 'total'));
    }

    public function websiteAdministrators() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($chat_list, $object);
            }
        }
        $administrators = User::where('type', 1)->where('is_delete', 0)->get();
        return view('admin.website-administrators', compact('profile', 'chat_counts', 'chat_list', 'administrators'));
    }

    public function getListingSingle(Request $request, $id)
    {
        $app_listings = RegularListing::where('tags', $id)
            ->leftJoin('users', 'regular_listings.user_id', '=', 'users.id')
            ->select('users.name AS user', 'regular_listings.event_date', 'regular_listings.title', 'regular_listings.details', 'regular_listings.municipality AS location', 'regular_listings.created_at')
            ->get();

        $app_quicks = QuickListing::where('tag', $id)
            ->leftJoin('users', 'quick_listings.user_id', '=', 'users.id')
            ->select('users.name AS user', 'quick_listings.event_date', 'quick_listings.title', 'quick_listings.request AS details', 'quick_listings.location', 'quick_listings.created_at')
            ->get();

        $a1 = json_encode($app_listings);
        $a2 = json_encode($app_quicks);

        $j1 = collect(json_decode($a1));
        $j2 = collect(json_decode($a2));

        $rawEmployments = collect($j1->merge($j2))->sortBy('event_date');
        $jobs = $rawEmployments->values()->all();

        return $jobs;
    }
}
