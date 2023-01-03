<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver'
    ];

    protected $cast = [
        'receiver' => 'integer',
        'sender' => 'integer'
    ];

    public function scopeChatRooms($query)
    {
        return $query->where('sender', auth()->user()->id)->orWhere('receiver', auth()->user()->id);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function receiver() 
    {
        return $this->belongsTo(User::class, 'receiver', 'id');
    }

    

}
