<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['notifications as unread_notifications_count' => function ($query) {
            $query->where('read', 0);
        }])->get();

        return view('users.index', compact('users'));
    }

}
