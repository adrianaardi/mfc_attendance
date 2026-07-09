<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\BrevoMailer;

class RegistrationController extends Controller
{
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

        $result = BrevoMailer::send(
            $registration->email,
            $registration->name,
            'Registration Confirmed — MFC 2026',
            view('emails.registration-confirmed', compact('registration'))->render()
        );

        $registration->update([
            'email_status' => $result['status'],
            'email_error'  => $result['error'],
        ]);

        return redirect('/')->with('success', 'Registration successful! A confirmation email has been sent.');
    }
}