<?php
// app/Models/ChatRoom.php
namespace App\Models;

use App\Models\User;
use App\Models\Donasi;
use App\Models\ChatMessage;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['donatur_id', 'penerima_id', 'donasi_id'];

    public function donatur()
    {
        return $this->belongsTo(User::class, 'donatur_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'room_id');
    }
}