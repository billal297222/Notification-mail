<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserFollowSmsNotification; // Vonage SMS notification

class GuestFollowSmsController extends Controller
{
    // Show form to guest
    public function showForm()
    {
        $users = User::all(); // List of users to follow
        return view('sms.guest_follow_sms', compact('users'));
    }

    // Handle follow submission
    public function submitFollow(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'guest_name' => 'required|string|max:255',
        ]);

        $userToFollow = User::findOrFail($data['user_id']);

        $guest = (object)[
            'name' => $data['guest_name'],
        ];

        // Send SMS notification via Vonage
        $userToFollow->notify(new UserFollowSmsNotification($guest));

        return back()->with('success', 'SMS sent! ' . $userToFollow->name . ' has been notified.');
    }
}
