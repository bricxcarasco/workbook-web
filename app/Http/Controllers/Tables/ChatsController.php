<?php

namespace App\Http\Controllers\Tables;

use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function getChats(Request $request, $id)
    {
        $myId = Auth::guard('web')->user()->id;
        $me = Chat::where('sender_id', $myId)->where('receiver_id', $id)->get();
        $you = Chat::where('sender_id', $id)->where('receiver_id', $myId)->get();

        Chat::where('sender_id', $id)->orWhere('receiver_id', $id)->update(['status' => 1]);
        
        $he = User::find($id);

        $merged = collect($me->merge($you))->sortBy('created_at');
        return response()->json(
            [
                'chats' => $merged->values()->all(),
                'user' => $he,
                'me' => Auth::guard('web')->user()
            ]
        );
    }

    public function sendMessage(Request $request)
    {
        $sender = Auth::guard('web')->user()->id;
        $receiver = $request->receiver;
        $message = $request->message;

        try {
            Chat::insert([
                'sender_id' => $sender,
                'receiver_id' => $receiver,
                'message' => $message
            ]);
            return 'Success';
        } catch (\Throwable $th) {
            return 'Failed';
        }
    }
}
