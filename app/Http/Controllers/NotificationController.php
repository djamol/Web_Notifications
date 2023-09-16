<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Auth;
class NotificationController extends Controller
{
    public function index()
    {
        // List all notifications
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }
    public function me()
    {
        // List all notifications
        $notifications = Notification::all();
        return view('notifications.user', compact('notifications'));
    }
    public function show(Notification $notification)
    {
         $notification->markAsRead($notification->id);
        return view('notifications.show', compact('notification'));
    }

    public function create()
    {
        $users = User::all();
        // Show the create notification form
        return view('notifications.post',compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'type' => 'required|in:marketing,invoices,system',
            'short_text' => 'required|string|max:255',
            'expiration' => 'required|date',
            'destination' => 'required|in:all,user',
        ]);

        if($request->destination=='user'){
            $notification = new Notification();
            $notification->type = $request->type;
            $notification->short_text = $request->short_text;
            $notification->expiration = $request->expiration;
            $notification->destination = $request->destination;
            $notification->notifiable_id = $request->specific_user_id;
            $notification->user_id =$request->user_id;
            $notification->notifiable_type = 'App\Models\User';
            $notification->save();
        }else{
        foreach (User::all() as $user) {
        $notification = new Notification();
        $notification->type = $request->type;
        $notification->short_text = $request->short_text;
        $notification->expiration = $request->expiration;
        $notification->destination = $request->destination;
        $notification->notifiable_id = $user->id;
        $notification->user_id =$request->user_id;
        $notification->notifiable_type = get_class($user);
        $notification->save();
        }
        }


        // Redirect
        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    public function edit(Notification $notification)
    {
        // Show the edit notification form
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        // Validate the form data
        $this->validate($request, [
            'type' => 'required|in:marketing,invoices,system',
            'short_text' => 'required|string|max:255',
            'expiration' => 'required|date',
            'destination' => 'required|in:all,user',
        ]);

        // Update the notification
        $notification->type = $request->type;
        $notification->short_text = $request->short_text;
        $notification->expiration = $request->expiration;
        $notification->destination = $request->destination;
        $notification->save();

        // Redirect back with a success message
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }
    public function getNotification(Request $request)
    {
        $search = $request->input('search');
        $filteredNotifications = Notification::where('short_text', 'like', '%' . $search . '%')->get();
       return response()->json($filteredNotifications);

    }
}
