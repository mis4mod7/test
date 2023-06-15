<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreditsUserDaily extends Command
{
    protected $signature = 'credits:user-daily';
    protected $description = 'Update users\' balances with daily credits';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Retrieve all users
        $users = User::all();

        foreach ($users as $user) {
            // Calculate the daily credits based on the user's balance
            $dailyCredits = $user->balance * 0.02;

            // Add the daily credits to the user's balance
            $user->balance += $dailyCredits;
            $user->save();
        }

        $this->info('Users\' balances have been updated with daily credits.');
    }
}
