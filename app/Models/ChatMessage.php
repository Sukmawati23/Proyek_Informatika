<?php
// app/Models/ChatMessage.php
namespace App\Models;

use App\Models\User;
use App\Models\ChatRoom;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['room_id', 'sender_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }

    public function room()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}