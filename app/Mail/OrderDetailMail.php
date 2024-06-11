<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderDetailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $file;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $message
     * @param string $file
     */
    public function __construct($subject, $message, $file)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->file = $file;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orderDetails',
            with: [
                'messageContent' => $this->message,
                'file' => $this->file
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->file)
                ->as('Order-Details.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
