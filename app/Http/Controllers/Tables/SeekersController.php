<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeekerMyProfileValidation;
use App\Seeker;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SeekersController extends Controller
{
    public function seekerList()
    {
        return User::where('is_delete', 0)->where('type', 3)->get();
    }

    public function seekerSingle(Request $request, $id)
    {
        $seeker = Seeker::where('user_id', $id)->first();
        if (empty($seeker))
            return "Empty";
        else 
            return $seeker;
    }
    
    public function seekerAdd(Request $request)
    {
        try {
            Seeker::insert($request->all());
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function seekerEdit(Request $request)
    {
        try {
            Seeker::where('id', $request->id)->update($request->all());
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function seekerDelete(Request $request)
    {
        try {
            $user = User::find($request->id);
            Seeker::where('user_id', $user->id)->update(['is_delete' => 1]);
            User::where('id', $request->id)->update(['is_delete' => 1]);
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function myProfileUpdate(SeekerMyProfileValidation $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        if (!is_null($request->image_upload)) {
            $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            request()->image_upload->move(public_path('images'), $imageName);
            $request->merge(['image' => $imageName]);
            User::where('id', $user_id)->update([
                'image' => $imageName
            ]);
        }

        $update = Seeker::where('id', $request->id)->update($request->except('_token', 'image_upload'));
        
        if ($update) {
            return redirect()->back()->with('message', 'Updated successfully!');
        }
    }
}
