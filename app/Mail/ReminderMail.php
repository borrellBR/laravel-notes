<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    public function __construct($note)
    {
        $this->note = $note;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Note Reminder Mail',
        );
    }

    public function build(){
        return $this->subject('Note Reminder')
                    ->text('emails.reminder');
    }
}
