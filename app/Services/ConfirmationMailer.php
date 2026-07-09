<?php

namespace App\Services;

use App\Mail\AttendanceConfirmed;
use App\Mail\RegistrationConfirmed;
use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;

class ConfirmationMailer
{
    /**
     * @return array{status: string, error: string|null}
     */
    public function sendRegistrationEmail(Registration $registration): array
    {
        try {
            Mail::to($registration->email)->send(new RegistrationConfirmed($registration));
            return ['status' => 'sent', 'error' => null];
        } catch (\Throwable $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array{status: string, error: string|null}
     */
    public function sendAttendanceEmail(Attendance $attendance): array
    {
        try {
            Mail::to($attendance->registration->email)->send(new AttendanceConfirmed($attendance->registration, $attendance));
            return ['status' => 'sent', 'error' => null];
        } catch (\Throwable $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }
}