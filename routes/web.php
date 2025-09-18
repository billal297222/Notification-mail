<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailNotiController;
 use App\Http\Controllers\UserFollowController;
 use App\Http\Controllers\GuestFollowSmsController;
 use App\Http\Controllers\MailController;

Route::get('/',[MailNotiController:: class,'index']);

Route::post('/follow', [UserFollowController::class, 'follow'])->name('user.follow');
Route::get('/follow-user', [UserFollowController::class, 'showFollowForm'])->name('follow.form');



// Show the SMS follow form
Route::get('/guest-follow-sms', [GuestFollowSmsController::class, 'showForm'])->name('guest.follow.sms.form');

// Handle SMS follow submission
Route::post('/guest-follow-sms', [GuestFollowSmsController::class, 'submitFollow'])->name('guest.follow.sms.submit');

//mail
Route::get('/send-mail', [MailController::class, 'index'])->name('mail.form');
Route::post('/send-mail', [MailController::class, 'sendMail'])->name('send.mail');







