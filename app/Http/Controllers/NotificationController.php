<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function index()
    {
        // List all notifications
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }
    public function show(Notification $notification)
    {
         $notification->markAsRead($notification->id);
        return view('notifications.show', compact('notification'));
    }


}
