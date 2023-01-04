<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $with = [
        'message'
    ];

    protected $fillable = [
        'type',
        'room_id',
        'user_id',
        'message_id',
        'read_at'
    ];

    public function scopeUserChat($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
