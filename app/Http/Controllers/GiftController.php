<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Gift;
use App\Models\User;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gifts = Gift::all();

        return view('gifts.index', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('gifts.create');
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
{
    $gift = new Gift();
    $gift->sender_id = Auth::id();
    $gift->receiver_id = $user->id;
    // Save other details of the gift
    $gift->save();

    return redirect()->route('user.profile', $user->id);
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
