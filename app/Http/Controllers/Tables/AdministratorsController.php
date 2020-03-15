<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdministratorsController extends Controller
{
    public function addAdministrator(Request $request)
    {
        try {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'type' => 1
            ]);
            return redirect()->back()->with('message', 'Administrator has been added!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function editAdministrator(Request $request)
    {
        try {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
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
