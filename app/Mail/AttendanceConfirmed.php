<?php

namespace App\Mail;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AttendanceConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public Registration $registration;
    public Attendance $attendance;

    public function __construct(Registration $registration, Attendance $attendance)
    {
        $this->registration = $registration;
        $this->attendance = $attendance;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Attendance Verified — Malaysian Forestry Conference 2026',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.attendance-confirmed',
        );
    }
}