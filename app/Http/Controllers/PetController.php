<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use App\Models\Asset;

use Carbon\Carbon;

class PetController extends Controller
{


    public function index()
    {
        $pets = Pet::all();

        return view('pets.index', compact('pets'));
    }

    public function purchase(Pet $pet)
{
    // Retrieve the authenticated user
    $user = auth()->user();

    // Check if the user already owns the pet
    if ($user->pets()->where('pets.id', $pet->id)->exists()) {
        return redirect()->route('pets.index')->with('error', 'You already own this pet.');
    }

    // Check if the user has enough balance to buy the pet
    if ($user->balance < $pet->price) {
        return redirect()->route('pets.index')->with('error', 'Insufficient balance to buy this pet.');
    }

    // Deduct the pet's price from the user's balance
    $user->balance -= $pet->price;
    $user->save();

    // Associate the pet with the user
    $user->pets()->attach($pet);

    return redirect()->route('pets.index')->with('success', 'Pet purchased successfully.');
}


public function feed(Pet $pet)
{
    // Get the authenticated user
    $user = auth()->user();

    // Check if the user is the owner of the pet
    if ($pet->user_id === $user->id) {
        return back()->with('error', 'You cannot feed your own pet.');
    }

    // Check if the pet has already been fed today
    $lastFedAt = $pet->last_fed_at;

    if ($lastFedAt && Carbon::parse($lastFedAt)->isToday()) {
        return back()->with('error', 'This pet has already been fed today.');
    }

    // Simulate random credits or assets
    $isCredits = (random_int(1, 100) <= 90); // 90% chance of receiving credits

    if ($isCredits) {
        $credits = random_int(10, 50);

        // Increment the user's balance with random credits
        $user->balance += $credits;
        $user->save();

        // Update the pet's last feeding time
        $pet->last_fed_at = Carbon::now();
        $pet->save();

        return back()->with('success', 'You fed the pet and received ' . $credits . ' credits.');
    } else {
        // Assuming you have an `Asset` model and assets available in your database
        $randomAsset = Asset::inRandomOrder()->first();

        // Associate the random asset with the user
        $user->assets()->attach($randomAsset, ['quantity' => 1]);

        // Update the pet's last feeding time
        $pet->last_fed_at = now();
        $pet->save();

        return back()->with('success', 'You fed the pet and received ' . $randomAsset->name . ' asset.');
    }
}

public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pet = new Pet();
        $pet->name = $request->input('name');
        $pet->price = $request->input('price');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pets', 'public');
            $pet->image = $imagePath;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet created successfully.');
    }

}
