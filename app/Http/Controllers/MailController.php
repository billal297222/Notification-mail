<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{

    public function index(){
        return view('emails.users.mailsentForm');
    }


    public function send(Request $request)
    {
        $request->validate([
            'recipient' => 'required|email',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        $details = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to($request->recipient)->send(new TestMail($details));

        return back()->with('success', 'Mail sent successfully to ' . $request->recipient);
    }
}
