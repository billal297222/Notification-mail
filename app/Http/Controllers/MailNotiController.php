<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Log;

class MailNotiController extends Controller
{
     public function index(){
        // $user=User::first();
        $users=User::all();
        $post=[
            'title'=>'post-title',
            'slug'=>'post-slug'
        ];

foreach ($users as $user) {
    try {
        $user->notify(new SendEmailNotification($post));
    } catch (\Exception $e) {
        Log::error("Failed to send email to {$user->email}: ".$e->getMessage());
    }

       
    }
}
}
