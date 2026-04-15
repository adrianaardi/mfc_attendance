<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttendanceConfirmed;
use Illuminate\Http\Request;

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

        Mail::to($registration->email)->send(new AttendanceConfirmed($registration, $attendance));

        return back()->with('attendance_success', "Attendance for Day {$request->day} verified! A confirmation email has been sent.");
    }
}