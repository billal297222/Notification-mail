<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test email.'
        ];

        Mail::to('recipient@example.com')->view('emails.user.mailsent');

        return "Email sent successfully!";
    }
}
