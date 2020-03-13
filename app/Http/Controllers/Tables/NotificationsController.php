<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
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
}
