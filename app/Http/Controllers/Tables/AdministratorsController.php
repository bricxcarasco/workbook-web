<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Chat;
use App\Http\Requests\AddAdministratorRequest;
use App\Http\Requests\EditAdministratorRequest;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\UserLog;
use Illuminate\Support\Facades\Auth;
use App\Seeker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use stdClass;

class AdministratorsController extends Controller
{
    public function getAdministrator() {
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
            if (isset($chatCheck['id'])) {
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

        return view('admin.add', compact('data_count', 'chat_list', 'chat_counts', 'profile'));
    }

    public function editAdministrator($id) {
        $edit_user = User::find($id);
        $user = Auth::guard('web')->user();
        $profile = $user;
        $usersExceptMe = User::where('id', '<>', $user->id)->get();
        $chat_counts = Chat::where('receiver_id', '<>' ,$user->id)->where('status', 0)->count();

        $chat_list = [];
        foreach ($usersExceptMe as $other) {
            $chatCheck = Chat::where('sender_id', $other->id)->where('receiver_id', $user->id)->orderBy('id', 'desc')->first();
            if (isset($chatCheck['id'])) {
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

        return view('admin.edit', compact('data_count', 'chat_list', 'chat_counts', 'profile', 'edit_user'));
    }

    public function addAdministrator(AddAdministratorRequest $request)
    {
        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['image_new' => $imageName]);

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['image_new' => $imageName]);
        }

        try {
            User::insert([
                'image' => $request->image_new,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_raw' => $request->password,
                'type' => 1
            ]);
            return redirect()->back()->with('message', 'Administrator has been added!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function updateAdministrator(EditAdministratorRequest $request)
    {
        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'password_raw' => $request->password
        ];

        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['image_new' => $imageName]);
            // $data['image'] = $imageName;

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['image_new' => $imageName]);
            $data['image'] = $imageName;
        }

        try {
            User::where('id', $request->id)->update($data);
            return redirect()->back()->with('message', 'Administrator has been updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function deleteAdministrator(Request $request)
    {
        try {
            User::where('id', $request->id)->update(['is_delete' => 1]);
            return redirect()->back()->with('message', 'Administrator has been deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
