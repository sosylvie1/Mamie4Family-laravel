<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
    ];

    /**
     * Relations avec User
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Marquer le message comme lu
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update(['is_read' => true]);
        }
    }

    /**
     * Accesseurs pratiques
     */
    public function getSenderNameAttribute(): string
    {
        return $this->sender ? $this->sender->name : '—';
    }

    public function getReceiverNameAttribute(): string
    {
        return $this->receiver ? $this->receiver->name : '—';
    }
}
