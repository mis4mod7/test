<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Chatroom extends Model
{
    protected $fillable = [
        'name'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

