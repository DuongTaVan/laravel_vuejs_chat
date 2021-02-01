<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }

    public function sendFile(Request $request)
    {
        if (request()->has('file')) {
            $filename = request('file')->store('public/chat');
            $message = Message::create([
                'user_id' => request()->user()->id,
                'image' => request('file')->store('chat'),
            ]);
        } else {
            $message = auth()->user()->messages()->create([
                'message' => $request->input('message')
            ]);

        }
        // broadcast(new MessageSent($user, $message))->toOthers();
        broadcast(new MessageSent(auth()->user(), $message->load('user')))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
