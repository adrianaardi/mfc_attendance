<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'day'   => 'required|integer|in:1,2,3',
        ]);

        $registration = Registration::where('email', $request->email)->first();

        if (!$registration) {
            return back()->with('attendance_error', 'Email not found. Please register first.');
        }

        $alreadyCheckedIn = Attendance::where('registration_id', $registration->id)
            ->where('day', $request->day)
            ->exists();

        if ($alreadyCheckedIn) {
            return back()->with('attendance_error', "You've already verified attendance for Day {$request->day}.");
        }

        $attendance = Attendance::create([
            'registration_id' => $registration->id,
            'day'             => $request->day,
            'checked_in_at'   => now(),
        ]);

        try {
            Http::withHeaders([
                'api-key'      => config('services.brevo.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name'  => 'MFC 2026',
                    'email' => 'adrianaardi.aa@gmail.com',
                ],
                'to' => [[
                    'email' => $registration->email,
                    'name'  => $registration->name,
                ]],
                'subject'     => 'Attendance Confirmed — MFC 2026',
                'htmlContent' => view('emails.attendance-confirmed', compact('registration', 'attendance'))->render(),
            ]);
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }

        return back()->with('attendance_success', "Attendance for Day {$request->day} verified! A confirmation email has been sent.");
    }
}