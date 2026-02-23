<?php

namespace App\Mail;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintDueDateReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Complaint $complaint
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Complaint Due Soon - ' . $this->complaint->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.complaint-due-reminder',
            with: [
                'complaint' => $this->complaint,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

