<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tables\NotificationsController;
use App\Http\Requests\ForgotPasswordRequest;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\Seeker;
use App\UserLog;
use App\WorkClass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcomePage()
    {
        $regular = RegularListing::count();
        $quick = QuickListing::count();
        $providers = UserLog::where('type', 2)->count();
        $seekers = UserLog::where('type', 3)->count();
        $providerCount = Provider::count();
        $seekerCount = Seeker::count();

        $categories = WorkClass::pluck('title');

        $data_count = array(
            'jobs' => ($regular + $quick),
            'providers' => $providerCount,
            'seekers' => $seekerCount,
            'users' => ($seekers + $providers)
        );

        return view('welcome', compact('data_count', 'categories'));
    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function updatePassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        $randomPassword = $this->random_strings(8);
        $password = Hash::make($randomPassword);

        try {
            $sendUser = NotificationsController::forgotPassword($user->email, $randomPassword, $user->name);
            $userUpdate = User::where('id', $user->id)->update([
                'password' => $password,
                'password_raw' => $randomPassword
            ]);
            return redirect()->back()->with('message', 'Check your email for password change!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
    
    public function random_strings($length_of_string) 
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),  
                        0, $length_of_string); 
    }
}
