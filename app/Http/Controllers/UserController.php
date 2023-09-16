<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['notifications as unread_notifications_count' => function ($query) {
            $query->where('read', 0);
        }])->get();

        return view('users.index', compact('users'));
    }
    public function show(User $user)
    {
        $user->load('notifications');

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Show the user settings form
        return view('users.settings', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'phone_number' =>  ['nullable', 'numeric', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
        ]);
        $user->email = $request->email;
        if($this->verifyPhone($request->phone_number)){
        $user->phone_number = $request->phone_number;
        }
        $user->save();

        // Redirect
        return redirect()->route('users.index')->with('success', 'User settings updated successfully.');
    }
    public function getUsers(Request $request)
    {
        $search = $request->input('search');
        $filter = User::select('name','email',)::where('name', 'like', '%' . $search . '%')->get();
       return response()->json($filter);

    }
    public function verifyPhone($phone_number){
        // Initialize MessageBird client
        $client = new Client(config('services.messagebird.api_key'));
        try {
            $lookup = $client->lookup->read($phoneNumber);
            $isValid = $lookup->getType() === 'mobile';
            if($isValid)
            return true;
        } catch (\Exception $e) {
            return false;
        }
        return false;

}
