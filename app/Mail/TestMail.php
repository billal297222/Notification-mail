<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject:$this->details['subject'] ?? 'Test Mail',

        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.users.mailsent',
             with: ['details' => $this->details],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
