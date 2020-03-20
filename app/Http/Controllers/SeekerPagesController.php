<?php

namespace App\Http\Controllers;

use App\Application;
use App\Chat;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use stdClass;

class SeekerPagesController extends Controller
{
    public function findJobs()
    {
        $regulars = RegularListing::where('regular_listings.is_delete', 0)
            ->where('regular_listings.status', 0)
            ->leftJoin('providers', 'regular_listings.user_id', '=', 'providers.id')
            ->select('regular_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address', 'providers.mailing_address', 'providers.telephone_number', 'providers.mobile_number', 'providers.facebook', 'providers.twitter', 'providers.instagram', 'providers.affiliation')
            ->get();
        
        $quicks = QuickListing::where('quick_listings.is_delete', 0)
            ->where('quick_listings.status', 0)
            ->leftJoin('providers', 'quick_listings.user_id', '=', 'providers.id')
            ->leftJoin('work_classes', 'quick_listings.tag', '=', 'work_classes.id')
            ->select('quick_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address','work_classes.title', 'work_classes.description', 'providers.mailing_address', 'providers.telephone_number', 'providers.mobile_number', 'providers.facebook', 'providers.twitter', 'providers.instagram', 'providers.affiliation')
            ->get();

        $providers = Provider::where('is_delete', 0)->get();
        $user = Auth::guard('web')->user();
        $seeker = Seeker::where('user_id', $user->id)->first();
        return view('seeker.find-jobs', compact('regulars','quicks','providers','user','seeker'));
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
        $userId = Auth::guard('web')->user()->id;
        $seeker = Seeker::where('user_id', $userId)->first();

        $app_listings = Application::where('applications.seeker_id', $seeker->id)
            ->where('applications.type', 1)
            ->leftJoin('regular_listings', 'applications.job_id', '=', 'regular_listings.id')
            ->select('regular_listings.*','applications.*')
            ->orderBy('applications.created_at', 'ASC')
            ->get();

        $app_quicks = Application::where('applications.seeker_id', $seeker->id)
        ->where('applications.type', 2)
            ->leftJoin('quick_listings', 'applications.job_id', '=', 'quick_listings.id')
            ->select('quick_listings.*','applications.*')
            ->orderBy('applications.created_at', 'ASC')
            ->get();

        return view('seeker.ongoing-applications', compact('app_listings', 'app_quicks', 'seeker'));
    }

    public function myMessages()
    {
        $user = Auth::guard('web')->user();
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $users = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()['id'];
            if (!is_null($chatCheck)) {
                $object = new stdClass;
                $object->id = $other->id;
                $object->name = $other->name;

                $type = 'Admin';
                $badge = 'primary';

                if ($other->type == 2) {
                    $type = 'Provider';
                    $badge = 'warning';
                } else {
                    $type = 'Seeker';
                    $badge = 'info';
                }

                $object->badge = $badge;
                $object->type = $type;
                $object->counts = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->where('status', 0)->count();
                $chatDesc = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
                $object->priority = $chatDesc->id;
                $object->message = (strlen($chatDesc->message) > 13) ? substr($chatDesc->message,0,10).'...' : $chatDesc->message;
                $object->status = $chatDesc->status;
                $object->created_at = Carbon::parse($chatDesc->created_at)->format('Y-m-d H:i');
                $object->created_date = $chatDesc->created_date;
                array_push($users, $object);
            }
        }

        return view('seeker.my-messages', compact('users'));
    }
}
