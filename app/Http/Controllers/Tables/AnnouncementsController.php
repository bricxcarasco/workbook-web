<?php

namespace App\Http\Controllers\Tables;

use App\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementValidation;

class AnnouncementsController extends Controller
{
    public function makeAnnouncement(AnnouncementValidation $request)
    {
        try {
            Announcement::insert([
                'title' => $request->subject,
                'target' => $request->target,
                'message' => $request->message
            ]);
            return redirect()->back()->with('message', 'Announcement has been made!');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteAnnouncement(Request $request)
    {
        try {
            Announcement::where('id', $request->id)->update(['is_delete' => 1]);
            return redirect()->back()->with('message', 'Announcement has been removed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
