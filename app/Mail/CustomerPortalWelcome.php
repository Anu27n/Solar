<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerPortalWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $customerName,
        public string $loginEmail,
        public string $temporaryPassword,
        public string $loginUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your customer portal login — ' . config('app.name', 'U.P.R. Solar'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.customer-portal-welcome',
        );
    }
}
