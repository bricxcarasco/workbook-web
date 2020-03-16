<?php

namespace App\Http\Controllers\Tables;

use App\CalendarEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class CalendarEventsController extends Controller
{
    public function calendarList(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $calendars = CalendarEvent::where('user_id', $userId)->orWhere('target_id', $userId)->select('title','start','end','color')->get();
        return $calendars;
    }

    public function addEvent(Request $request)
    {
        $user = Auth::guard('web')->user();
        $targets = [];
        if ($request->target == 2) {
            $targets = User::where('type', 2)->where('is_delete', 0)->get();
        } else if ($request->target == 3) {
            $targets = User::where('type', 3)->where('is_delete', 0)->get();
        } else if ($request->target == 4) {
            $targets = User::where('is_delete', 0)->get();
        }

        try {
            if (empty($targets)) {
                CalendarEvent::insert([
                    'user_id' => $user->id,
                    'target_id' => $user->id,
                    'from_user' => 1,
                    'to_user' => 1,
                    'title' => $request->title,
                    'start' => $request->start_date,
                    'end' => $request->end_date,
                    'color' => $request->color
                ]);
            } else {
                foreach ($targets as $target) {
                    CalendarEvent::insert([
                        'user_id' => $user->id,
                        'target_id' => $target->id,
                        'from_user' => 1,
                        'to_user' => $target->type,
                        'title' => $request->title,
                        'start' => $request->start_date,
                        'end' => $request->end_date,
                        'color' => $request->color
                    ]);
                }
            }
            return 'Success';
        } catch (\Throwable $th) {
            return  'Failed';
        }

    }
}
