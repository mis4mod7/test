<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Multicaret\Acquaintances\Traits\Friendable;
use App\Models\Friendship;
use App\Models\Message;
use App\Models\Gift;
use App\Models\Asset;
use App\Models\Pet;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    protected $fillable = [
        'name', 'email', 'password', 'balance', 'level', 'total_credits_spent',
    ];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function gifts()
{
    return $this->hasMany(Gift::class);
}

public function getTotalGiftsAttribute()
{
    return $this->gifts()->count();
}

public function assets()
{
    return $this->belongsToMany(Asset::class)->withPivot('quantity');
}

public function pets()
{
    return $this->belongsToMany(Pet::class);
}

public function updateLevel()
{
    $this->level = floor($this->total_credits_spent / 1000) + 1;
    $this->save();
}

public function updateBadge()
{
    $level = $this->level;

    // Calculate the badge based on the level
    $badge = '';
    $badgeImage = '';

    if ($level >= 1 && $level < 25) {
        $badge = 'Newbie';
        $badgeImage = 'path/to/newbie-badge.png';
    } elseif ($level >= 25 && $level < 100) {
        $badge = 'Pro';
        $badgeImage = 'path/to/pro-badge.png';
    } elseif ($level >= 100 && $level < 200) {
        $badge = 'Master';
        $badgeImage = 'path/to/master-badge.png';
    } elseif ($level >= 200 && $level < 400) {
        $badge = 'Elite';
        $badgeImage = 'path/to/elite-badge.png';
    } elseif ($level >= 400 && $level < 800) {
        $badge = 'Legend';
        $badgeImage = 'path/to/legend-badge.png';
    } elseif ($level >= 800 && $level < 1600) {
        $badge = 'Titan';
        $badgeImage = 'path/to/titan-badge.png';
    } else {
        $badge = 'Unstoppable';
        $badgeImage = 'path/to/unstoppable-badge.png';
    }

    // Update the user's badge and badge image
    $this->badge = $badge;
    $this->badge_image = $badgeImage;
    $this->save();
}



}

