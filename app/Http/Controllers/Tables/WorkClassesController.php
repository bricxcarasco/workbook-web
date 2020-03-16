<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkClass;

class WorkClassesController extends Controller
{
    public function addWorkClass(Request $request)
    {
        try {
            WorkClass::insert($request->all());
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }

    public function editWorkClass(Request $request)
    {
        try {
            WorkClass::where('id', $request->id)->update($request->all());
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }

    public function deleteWorkClass(Request $request)
    {
        try {
            WorkClass::where('id', $request->id)->update(['is_delete' => 1]);
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }
}
