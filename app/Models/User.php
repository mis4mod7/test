<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Friendship;
use App\Models\Message;
use App\Models\Gift;
use App\Models\Asset;
use App\Models\Pet;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'balance'
    ];

    public function friendships()
    {
        return $this->hasMany(Friendship::class);
    }

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

}

