<?php

namespace App\Http\Controllers;

use App\Application;
use App\Chat;
use App\Http\Requests\ChangePasswordRequest;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use stdClass;

class SeekerPagesController extends Controller
{
    public function findJobs()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $regulars = RegularListing::where('regular_listings.is_delete', 0)
            ->where('regular_listings.status', 0)
            ->leftJoin('providers', 'regular_listings.user_id', '=', 'providers.user_id')
            ->select('regular_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address', 'providers.mailing_address', 'providers.telephone_number', 'providers.mobile_number', 'providers.facebook', 'providers.twitter', 'providers.instagram', 'providers.affiliation')
            ->orderBy('regular_listings.id', 'DESC')
            ->get();
        
        $quicks = QuickListing::where('quick_listings.is_delete', 0)
            ->where('quick_listings.status', 0)
            ->leftJoin('providers', 'quick_listings.user_id', '=', 'providers.user_id')
            ->leftJoin('work_classes', 'quick_listings.tag', '=', 'work_classes.id')
            ->select('quick_listings.*', 'providers.business_name', 'providers.business_type', 'providers.image as p_image', 'providers.email_address','work_classes.title', 'work_classes.description', 'providers.mailing_address', 'providers.telephone_number', 'providers.mobile_number', 'providers.facebook', 'providers.twitter', 'providers.instagram', 'providers.affiliation')
            ->orderBy('quick_listings.id', 'DESC')
            ->get();

        $providers = Provider::where('is_delete', 0)->get();
        $user = Auth::guard('web')->user();
        $seeker = Seeker::where('user_id', $user->id)->first();
        // return compact('profile', 'chat_counts', 'regulars','quicks','providers','user','seeker');
        return view('seeker.find-jobs', compact('profile', 'chat_counts', 'regulars','quicks','providers','user','seeker'));
    }

    public function myCalendar()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();
        return view('seeker.my-calendar', compact('profile', 'chat_counts'));
    }

    public function mySchedule()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();
        return view('seeker.my-schedule', compact('profile', 'chat_counts'));
    }

    public function myProfile()
    {
        $userId = Auth::guard('web')->user()->id;
        $profile = Auth::guard('web')->user();
        $chat_counts = Chat::where('receiver_id', '<>' ,$userId)->where('status', 0)->count();
        $seeker = Seeker::where('user_id', $userId)->first();
        return view('seeker.my-profile', compact('profile', 'chat_counts', 'seeker'));
    }

    public function changePassword()
    {
        $userId = Auth::guard('web')->user()->id;
        $profile = Auth::guard('web')->user();
        $chat_counts = Chat::where('receiver_id', '<>' ,$userId)->where('status', 0)->count();

        $seeker = Seeker::where('user_id', $userId)->first();
        return view('seeker.change-password', compact('profile', 'chat_counts', 'seeker'));
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = Auth::guard('web')->user();

        if ($user->password_raw != $request->current_password) {
            return redirect()->back()->with('error', 'Invalid current password!');
        }

        try {
            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
                'password_raw' => $request->new_password
            ]);
            return redirect()->back()->with('message', 'Password successfully changed!');
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Internal server error!');
        }

        return $request->all();
    }

    public function ongoingApplications()
    {
        $userId = Auth::guard('web')->user()->id;
        $profile = Auth::guard('web')->user();
        $chat_counts = Chat::where('receiver_id', '<>' ,$userId)->where('status', 0)->count();
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

        return view('seeker.ongoing-applications', compact('profile', 'chat_counts', 'app_listings', 'app_quicks', 'seeker'));
    }

    public function myMessages()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $users = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
            if (isset($chatCheck['id'])) {
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

        return view('seeker.my-messages', compact('profile', 'chat_counts', 'users'));
    }
}
