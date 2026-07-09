<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Services\ConfirmationMailer;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct(protected ConfirmationMailer $mailer)
    {
    }

    public function show()
    {
        return view('event-register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:registrations,email',
            'phone'       => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'agency'      => 'required|string|max:255',
        ]);

        $registration = Registration::create($validated);

        $result = $this->mailer->sendRegistrationEmail($registration);
        $registration->update([
            'email_status' => $result['status'],
            'email_error'  => $result['error'],
        ]);

        $message = $result['status'] === 'sent'
            ? 'Registration successful! A confirmation email has been sent.'
            : 'Registration successful! However, the confirmation email could not be sent — our team will follow up.';

        return redirect('/')->with('success', $message);
    }
}