<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pet_user')
            ->withTimestamps();
    }
}
