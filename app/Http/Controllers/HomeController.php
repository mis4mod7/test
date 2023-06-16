<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatroom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        // $friends = $user->friendships()->with('friend')->get();
        $recentChats = $user->messages()->with('chatroom')->orderByDesc('created_at')->take(5)->get();
        $chatrooms = Chatroom::all();

        return view('home', compact('recentChats', 'chatrooms'));
    }
}
