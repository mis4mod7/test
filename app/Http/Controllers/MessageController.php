<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatroom;
use App\Models\Message;
use App\Models\Gift;
use App\Models\User;
use App\Models\Transaction;
use Auth;
use Pusher\Pusher;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $chatroom = Chatroom::findOrFail($id);
        $user = Auth::user();

    $message2 = $request->input('content');

    // Check if the message starts with the '/gift' command
    if (Str::startsWith($message2, '/gift')) {
        $args = explode(' ', $message2);

        // Ensure the command has the correct number of arguments
        if (count($args) !== 3) {
            return back()->with('error', 'Invalid gift command.');
        }

        $sender = Auth::user();
        $username = $args[1];
        $giftName = $args[2];

        // Find the receiver by their username
        $receiver = User::where('name', $username)->first();

        // Ensure the receiver exists
        if (!$receiver) {
            return back()->with('error', 'Invalid receiver username.');
        }

        // Find the gift by its name
        $gift = Gift::where('name', $giftName)->first();

        // Ensure the gift exists
        if (!$gift) {
            return back()->with('error', 'Invalid gift name.');
        }

        // Check if the user has sufficient balance to send the gift
        if ($user->balance < $gift->cost) {
            return back()->with('error', 'Insufficient balance to send the gift.');
        }

        // Deduct the gift cost from the user's balance
        $user->balance -= $gift->cost;
        $user->save();

        //  this is how to use transactions
        $transaction = new Transaction();
        $transaction->user_id = $sender->id;
        $transaction->amount = -$gift->cost;
        $transaction->type = 'Sent '.$gift->name.' To '. $receiver->name;
        $transaction->save();

        // Increment the receiver's gifts count
        $receiver->gifts += 1;
        $receiver->save();

        // Store the gift in the database or perform any additional actions as needed

        // Create a new message to save in the chatroom
        $globalMessage = new Message();
        $globalMessage->user_id = null;
        $globalMessage->chatroom_id = $chatroom->id;
        $globalMessage->content = $sender->name . ' has sent ' . $gift->name . ' to ' . $receiver->name;
        $globalMessage->save();

        // Return a success message
        return back()->with('success', 'Gift sent successfully.');
    }
    else{
        $message = $chatroom->messages()->create([
            'user_id' => $user->id,
            'content' => $request->input('content')
        ]);

        return redirect()->back();
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
