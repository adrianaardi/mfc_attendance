<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmed;
use Illuminate\Support\Facades\Log;

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
            Mail::to($registration->email)->queue(new RegistrationConfirmed($registration));
        } catch (\Exception $e) {
            dd('Mail error: ' . $e->getMessage());
        }
        return redirect('/')->with('success', 'Registration successful! A confirmation email has been sent.');
    }
}