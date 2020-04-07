<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\UserLog;
use Illuminate\Support\Facades\Auth;
use App\Seeker;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use stdClass;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first()->id;
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

        UserLog::insert(['user_id' => Auth::guard('web')->user()->id, 'type' => 1, 'created_at' => Carbon::now()->format('Y-m-d')]);
        $regular = RegularListing::count();
        $quick = QuickListing::count();
        $providers = Provider::count();
        $seekers = Seeker::count();

        $data_count = array(
            'jobs' => ($regular + $quick),
            'providers' => $providers,
            'seekers' => $seekers,
            'users' => ($seekers + $providers)
        );

        return view('admin.dashboard', compact('data_count', 'chat_list', 'chat_counts', 'profile'));
    }
}
