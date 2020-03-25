<?php

namespace App\Http\Controllers\Tables;

use App\Application;
use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyQuickJobValidation;
use App\QuickListing;
use App\Seeker;
use Illuminate\Support\Facades\Auth;

class QuickListingsController extends Controller
{
    public function getQuickJobListingSingle(Request $request, $id)
    {
        return QuickListing::find($id);
    }

    public function updateQuickJobListing(Request $request)
    {
        try {
            QuickListing::where('id', $request->id)->update($request->all());
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }

    public function deleteQuickJobListing(Request $request)
    {
        try {
            QuickListing::where('id', $request->id)->update(['is_delete' => 1]);
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }

    public function applyQuickJob($id)
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();
        $quick = QuickListing::find($id);
        return view('seeker.apply-quick-job', compact('profile', 'quick', 'chat_counts'));
    }

    public function applyQuickJobSend(ApplyQuickJobValidation $request)
    {
        if (!is_null($request->image_upload)) {
            $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            request()->image_upload->move(public_path('images'), $imageName);
            $request->merge(['resume' => $imageName]);
        }

        if (!is_null($request->identification)) {
            $imageNameID = time().'.'.request()->identification->getClientOriginalExtension();
            request()->identification->move(public_path('images'), $imageNameID);
            $request->merge(['valid_id' => $imageNameID]);
        }

        $user_id = Auth::guard('web')->user()->id;
        $id = Seeker::where('user_id', $user_id)->first();
        $quick_id = $request->quick_id;

        try {
            //code...
            Application::insert([
                'job_id' => $quick_id,
                'seeker_id' => $id->id,
                'type' => 2,
                'event_date' => $request->event_date,
                'resume' => $request->resume,
                'valid_id' => $request->valid_id,
                'message' => $request->message,
                'status' => 1,
            ]);
            return redirect()->route('ongoing-applications')->with('message', 'You applied successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('ongoing-applications')->with('error', $th->getMessage());
        }
    }

    public function cancelQuick(Request $request, $id)
    {
        try {
            //code...
            Application::where('id', $id)->update(['status'=>4]);
            return redirect()->back()->with('message', 'Application has been cancelled!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
