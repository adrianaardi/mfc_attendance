<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        try {
            Http::withHeaders([
                'api-key'      => config('services.brevo.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name'  => 'MFC 2026',
                    'email' => 'noreply@mfc2026.com',
                ],
                'to' => [[
                    'email' => $registration->email,
                    'name'  => $registration->name,
                ]],
                'subject'     => 'Registration Confirmed — MFC 2026',
'htmlContent' => view('emails.registration-confirmed', compact('registration'))->render(),            ]);
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }

        return redirect('/')->with('success', 'Registration successful! A confirmation email has been sent.');
    }
}