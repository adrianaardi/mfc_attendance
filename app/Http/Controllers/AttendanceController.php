<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Services\BrevoMailer;

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

        $result = BrevoMailer::send(
            $registration->email,
            $registration->name,
            'Attendance Confirmed — MFC 2026',
            view('emails.attendance-confirmed', compact('registration', 'attendance'))->render()
        );

        $attendance->update([
            'email_status' => $result['status'],
            'email_error'  => $result['error'],
        ]);

        return back()->with('attendance_success', "Attendance for Day {$request->day} verified! A confirmation email has been sent.");
    }
}