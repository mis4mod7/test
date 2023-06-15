<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    public function index()
    {
        $assets = Asset::all();
    $user = auth()->user();

    return view('assets.index', compact('assets', 'user'));
    }

public function purchase(Asset $asset)
{
    // Get the authenticated user
    $user = auth()->user();

    // Check if the user has sufficient balance to purchase the asset
    if ($user->balance < $asset->cost) {
        return back()->with('error', 'Insufficient balance to purchase the asset.');
    }

    // Deduct the asset cost from the user's balance
    $user->balance -= $asset->cost;
    $user->save();

    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->amount = -$asset->cost;
    $transaction->type = 'Bought '.$asset->name;
    $transaction->save();

    // Associate the asset with the user
    $user->assets()->attach($asset, ['quantity' => 1]);




    return back()->with('success', 'Asset purchased successfully.');
}

public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $asset = new Asset();
        $asset->name = $request->input('name');
        $asset->cost = $request->input('cost');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets', 'public');
            $asset->image = $imagePath;
        }

        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }


}
