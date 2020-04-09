<?php

namespace App\Http\Controllers\Tables;

use App\Application;
use App\CalendarEvent;
use App\Hiring;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Provider;
use App\Seeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationsController extends Controller
{
    public static function reactivateAccount($email, $password, $name)
    {
        $to_name = $name;
        $to_email = $email;

        $data = array(
            'name'=> $name,
            'password' => $password
        );

        Mail::send('mails.reactivated', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Reactivated Account');
            $message->from('workbookweblaguna@gmail.com', 'WorkBook Team');
            // hyperx1234
        });
    }

    public static function disableAccount($email, $name)
    {
        $to_name = $name;
        $to_email = $email;

        $data = array(
            'name' => $name
        );

        Mail::send('mails.disabled', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Account has been temporarily locked');
            $message->from('workbookweblaguna@gmail.com','WorkBook Team');
            // hyperx1234
        });
    }

    public static function createAccount($email, $username, $password, $name)
    {
        $to_name = $name;
        $to_email = $email;

        $data = array(
            'name' => $name,
            'username' => $username,
            'password' => $password
        );

        Mail::send('mails.created', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('WorkBook account creation success');
            $message->from('workbookweblaguna@gmail.com','WorkBook Team');
            // hyperx1234
        });
    }

    public static function sendPositive(Request $request)
    {
        $id = $request->id;
        $message2 = $request->message;
        $lookfor = $request->lookfor;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $location = $request->location;
        $status = $request->status;
        $color = $request->color;

        $application = Application::find($id);
        $seeker = Seeker::where('id', $application->seeker_id)->first();
        $user = Auth::guard('web')->user();
        $provider = Provider::where('user_id', $user->id)->first();

        Hiring::insert([
            'application_id' => $id,
            'provider_id' => $provider->id,
            'seeker_id' => $seeker->id,
            'interview_start_date' => $start_date,
            'interview_end_date' => $end_date,
            'interview_location' => $location,
            'contact_person' => $lookfor,
            'message' => $message2,
            'status' => $status
        ]);

        CalendarEvent::insert([
            'user_id' => $user->id,
            'target_id' => $seeker->user_id,
            'from_user' => 2,
            'to_user' => 3,
            'title' => $message2,
            'start' => $start_date,
            'end' => $end_date,
            'color' => $color
        ]);

        Application::where('id', $id)->update(['status' => $status]);

        $to_name = $seeker->full_name;
        $to_email = $seeker->email_address;

        $data = array(
            'name' => $seeker->full_name,
            'message2' => $message2,
            'date' => $start_date,
            'time' => $end_date,
            'location' => $location,
            'provider' => $provider->business_name
        );

        // dd($data);

        try {
            //code...
            Mail::send('mails.positive', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('WorkBook Application Process');
                $message->from('workbookweblaguna@gmail.com','WorkBook Team');
                // hyperx1234
            });
            return 'Success';
        } catch (\Throwable $th) {
            //throw $th;
            Log::debug($th->getMessage());
            return 'Failed';
        }
    }

    public static function sendNegative(Request $request)
    {
        $id = $request->id;
        $message2 = $request->reason;
        $status = $request->status;

        $application = Application::find($id);
        $seeker = Seeker::where('id', $application->seeker_id)->first();
        $user = Auth::guard('web')->user()->id;
        $provider = Provider::where('user_id', $user)->first();

        Hiring::insert([
            'application_id' => $id,
            'provider_id' => $provider->id,
            'seeker_id' => $seeker->id,
            'message' => $message2,
            'status' => $status
        ]); 

        Application::where('id', $id)->update(['status' => $status]);

        $to_name = $seeker->full_name;
        $to_email = $seeker->email_address;

        $data = array(
            'name' => $seeker->full_name,
            'message2' => $message2,
            'provider' => $provider->business_name
        );

        try {
            //code...
            Mail::send('mails.negative', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('WorkBook Application Process');
                $message->from('workbookweblaguna@gmail.com','WorkBook Team');
                // hyperx1234
            });
            return 'Success';
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return 'Failed';
        }
    }

    public static function forgotPassword($email, $password, $name)
    {
        $to_name = $name;
        $to_email = $email;

        $data = array(
            'name'=> $name,
            'password' => $password
        );

        Mail::send('mails.forgot', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Forgot Password Account');
            $message->from('workbookweblaguna@gmail.com', 'WorkBook Team');
            // hyperx1234
        });
    }
}
