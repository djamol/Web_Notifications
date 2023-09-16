<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function isExpired()
    {
        return now()->greaterThanOrEqualTo($this->expiration);
    }
    public function markAsRead($notificationId)
    {
        $notification = DatabaseNotification::find($notificationId);

        if ($notification && $notification->notifiable_id == Auth::id()) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marked as read.');
        } else {
            return redirect()->back()->with('error', 'Notification not found or not accessible.');
        }
    }

}
