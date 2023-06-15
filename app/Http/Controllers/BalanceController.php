<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function showTransferForm()
    {
        // Retrieve the users to populate the select dropdown
        $users = User::all();

        return view('transfer', compact('users'));
    }

    public function transfer(Request $request)
{
    $request->validate([
        'to_user_name' => 'required|exists:users,name',
        'amount' => 'required|numeric|min:0',
    ]);

    $fromUser = auth()->user();
    $toUser = User::where('name', $request->to_user_name)->firstOrFail();

    // Calculate the transfer charge (2% of the transfer amount)
    $transferCharge = $request->amount * 0.02;

    // Deduct the transfer amount plus the transfer charge from the sender's balance
    $totalAmount = $request->amount + $transferCharge;

    if ($fromUser->balance < $totalAmount) {
        return back()->with('error', 'Insufficient balance.');
    }

    $fromUser->balance -= $totalAmount;
    $toUser->balance += $request->amount;

    $fromUser->save();
    $toUser->save();

    return back()->with('success', 'Balance transferred successfully.');
}


}
