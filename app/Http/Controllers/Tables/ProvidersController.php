<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tables\NotificationsController;
use App\Http\Requests\MyProfileValidation;
use App\Provider;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProvidersController extends Controller
{
    public function providerList()
    {
        return User::where('type', 2)->get();
    }

    public function providerSingle(Request $request, $id)
    {
        $provider = Provider::where('user_id', $id)->first();
        if (empty($provider))
            return "Empty";
        else 
            return $provider;
    }
    
    public function providerAdd(Request $request)
    {
        $randomPassword = $this->random_strings(8);
        $password = Hash::make($randomPassword);


        $user = new User;
        $user->email = $request->email_address;
        $user->type = 2;
        $user->password = $password;
        $user->name = $request->business_name;

        if ($user->save()) {
            $request->merge(['user_id' => $user->id]);
        }

        Provider::insert($request->all());
        $createUserSendEmail = NotificationsController::createAccount($request->email_address, $request->email_address, $randomPassword, $request->business_name);

        return "Success";
    }

    public function providerEdit(Request $request)
    {
        try {
            Provider::where('id', $request->id)->update($request->all());
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function providerDelete(Request $request)
    {
        try {
            $user = User::find($request->id);
            Provider::where('user_id', $user->id)->update(['is_delete' => 1]);
            User::where('id', $request->id)->update(['is_delete' => 1]);
            NotificationsController::disableAccount($user->email, $user->name);
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function providerEnable(Request $request)
    {
        $user = User::find($request->id);

        $randomPassword = $this->random_strings(8);
        $password = Hash::make($randomPassword);

        $sendUser = NotificationsController::reactivateAccount($user->email, $randomPassword, $user->name);

        $userUpdate = User::where('id', $request->id)->update([
            'is_delete' => 0,
            'password' => $password
        ]);
        $providerUpdate = Provider::where('user_id', $request->id)->update([
            'is_delete' => 0
        ]);
        
        return 'Success';
    }

    public function myProfileUpdate(MyProfileValidation $request)
    {
        if (!is_null($request->image_upload)) {
            $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            request()->image_upload->move(public_path('images'), $imageName);
            $request->merge(['image' => $imageName]);
        }

        $update = Provider::where('id', $request->id)->update($request->except('_token', 'image_upload'));
        
        if ($update) {
            return redirect()->back()->with('message', 'Updated successfully!');
        }
    }

    public function random_strings($length_of_string) 
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),  
                        0, $length_of_string); 
    }

}
