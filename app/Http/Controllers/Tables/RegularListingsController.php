<?php

namespace App\Http\Controllers\Tables;

use App\Application;
use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyRegularJobValidation;
use App\RegularListing;
use App\Seeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegularListingsController extends Controller
{
    public function getJobListingAll()
    {
        return RegularListing::where('is_delete', 0)->get();
    }

    public function applyRegularJob($id)
    {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();
        $listing = RegularListing::find($id);
        return view('seeker.apply-listing-job', compact('profile', 'listing', 'chat_counts'));
    }

    public function applyRegularJobSend(ApplyRegularJobValidation $request)
    {
        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['resume' => $imageName]);

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['resume' => $imageName]);
        }

        if (!is_null($request->identification)) {
            // $imageNameID = time().'.'.request()->identification->getClientOriginalExtension();
            // request()->identification->move(public_path('images'), $imageNameID);
            // $request->merge(['valid_id' => $imageNameID]);

            $fileDTI = $request->file('identification');
            $dtiname = time() . '.' . $fileDTI->getClientOriginalExtension();
            $fileDTIPath = 'uploads/' . $dtiname;
            Storage::disk('s3')->put($fileDTIPath, file_get_contents($fileDTI));
            $imageNameID = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$dtiname;

            $request->merge(['valid_id' => $imageNameID]);
        }

        $user_id = Auth::guard('web')->user()->id;
        $id = Seeker::where('user_id', $user_id)->first();
        $listing_id = $request->listing_id;

        try {
            //code...
            Application::insert([
                'job_id' => $listing_id,
                'seeker_id' => $id->id,
                'type' => 1,
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

    public function cancelListing(Request $request, $id)
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
