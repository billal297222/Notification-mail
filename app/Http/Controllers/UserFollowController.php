<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowNotification;
use App\Notifications\UserFollowSmsNotification;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function showFollowForm()
    {

        $users = User::all();
        return view('emails.users.follow', compact('users'));
    }

    public function follow(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email'
        ]);

        $userToFollow = User::findOrFail($data['user_id']);

        $guestInfo = (object)[
            'name' => $data['guest_name'],
            'email' => $data['guest_email']
        ];

        $userToFollow->notify(new UserFollowNotification($guestInfo));

        // Send SMS Notification via Nexmo
        // $userToFollow->notify(new UserFollowSmsNotification($guest));


        return back()->with('success', 'You are now following ' . $userToFollow->name);
    }
}
