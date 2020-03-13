<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seeker;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
}
