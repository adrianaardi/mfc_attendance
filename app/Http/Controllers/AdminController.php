<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Services\BrevoMailer;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->get();
        $day1 = Attendance::with('registration')->where('day', 1)->latest()->get();
        $day2 = Attendance::with('registration')->where('day', 2)->latest()->get();
        $day3 = Attendance::with('registration')->where('day', 3)->latest()->get();
        $multiDayAttendees = Attendance::with('registration')
            ->select('registration_id')
            ->selectRaw('COUNT(DISTINCT day) as days_attended')
            ->selectRaw('MAX(checked_in_at) as last_check_in_at')
            ->selectRaw('MAX(id) as latest_attendance_id')
            ->groupBy('registration_id')
            ->havingRaw('COUNT(DISTINCT day) >= 2')
            ->orderByDesc('days_attended')
            ->orderByDesc('last_check_in_at')
            ->get();

        $latestAttendanceStatuses = Attendance::whereIn('id', $multiDayAttendees->pluck('latest_attendance_id')->filter()->all())
            ->get(['id', 'email_status'])
            ->keyBy('id');

        $multiDayAttendees->each(function ($attendee) use ($latestAttendanceStatuses) {
            $attendee->multi_day_email_status = $latestAttendanceStatuses[$attendee->latest_attendance_id]->email_status ?? 'pending';
        });

        $settings = [
            'registration'    => \App\Models\Setting::isEnabled('registration'),
            'attendance_day1' => \App\Models\Setting::isEnabled('attendance_day1'),
            'attendance_day2' => \App\Models\Setting::isEnabled('attendance_day2'),
            'attendance_day3' => \App\Models\Setting::isEnabled('attendance_day3'),
        ];

        return view('admin', compact('registrations', 'day1', 'day2', 'day3', 'multiDayAttendees', 'settings'));
    }

    public function sendMultiDayEmails(Request $request)
    {
        $registrationIds = $request->input('ids', []);

        if (empty($registrationIds)) {
            return back()->with('admin_error', 'No records selected.');
        }

        $pdfView = extension_loaded('gd')
            ? 'emails.certificate-placeholder'
            : 'emails.certificate-placeholder-basic';

        $latestAttendanceIds = Attendance::query()
            ->selectRaw('MAX(id) as latest_attendance_id')
            ->whereIn('registration_id', $registrationIds)
            ->groupBy('registration_id')
            ->pluck('latest_attendance_id');

        $attendances = Attendance::with('registration')->whereIn('id', $latestAttendanceIds)->get();

        if ($attendances->isEmpty()) {
            return back()->with('admin_error', 'No eligible attendance records found.');
        }

        $sentCount = 0;
        $failedCount = 0;

        foreach ($attendances as $attendance) {
            $registration = $attendance->registration;

            try {
                $pdfContent = Pdf::loadView($pdfView, compact('registration'))->output();
                $attachments = [[
                    'content' => base64_encode($pdfContent),
                    'name' => 'digital-certificate-test.pdf',
                ]];

                $result = BrevoMailer::send(
                    $registration->email,
                    $registration->name,
                    'Digital Certificate (Test) — MFC 2026',
                    view('emails.certificate-mail', compact('registration'))->render(),
                    $attachments
                );

                $attendance->email_status = $result['status'];
                $attendance->email_error = $result['error'];
                $attendance->save();

                if ($result['status'] === 'sent') {
                    $sentCount++;
                } else {
                    $failedCount++;
                }
            } catch (Throwable $e) {
                $attendance->email_status = 'failed';
                $attendance->email_error = 'Certificate generation failed: '.$e->getMessage();
                $attendance->save();
                $failedCount++;
            }
        }

        if ($failedCount > 0) {
            return back()->with('admin_error', "{$sentCount} email(s) sent, {$failedCount} failed.");
        }

        return back()->with('admin_success', "{$sentCount} email trigger(s) sent successfully.");
    }

    public function export($day)
    {
        if ($day === 'registrations') {
            $rows = Registration::latest()->get();

            $filename = 'registrations.csv';
            $headers = [
                'Content-Type'        => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function () use ($rows) {
                $file = fopen('php://output', 'w');

                // Heading row
                fputcsv($file, [
                    'No.',
                    'Full Name',
                    'Email',
                    'Phone',
                    'Designation',
                    'Agency / Organisation',
                    'Registered At',
                ]);

                foreach ($rows as $i => $reg) {
                    fputcsv($file, [
                        $i + 1,
                        $reg->name,
                        $reg->email,
                        $reg->phone,
                        $reg->designation,
                        $reg->agency,
                        $reg->created_at->format('d M Y, h:i A'),
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Day attendance export
        $rows = Attendance::with('registration')
            ->where('day', $day)
            ->latest()
            ->get();

        $filename = "attendance-day{$day}.csv";
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rows, $day) {
            $file = fopen('php://output', 'w');

            // Heading row
            fputcsv($file, [
                'No.',
                'Full Name',
                'Email',
                'Phone',
                'Designation',
                'Agency / Organisation',
                'Check-in Time',
            ]);

            foreach ($rows as $i => $att) {
                fputcsv($file, [
                    $i + 1,
                    $att->registration->name,
                    $att->registration->email,
                    $att->registration->phone,
                    $att->registration->designation,
                    $att->registration->agency,
                    \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function deleteRegistrations(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('admin_error', 'No records selected.');

        // Deletes attendance too via cascade (or manually)
        Attendance::whereIn('registration_id', $ids)->delete();
        Registration::whereIn('id', $ids)->delete();

        return back()->with('admin_success', count($ids) . ' registration(s) deleted.');
    }

    public function deleteAttendances(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('admin_error', 'No records selected.');

        Attendance::whereIn('id', $ids)->delete();

        return back()->with('admin_success', count($ids) . ' attendance record(s) deleted.');
    }

    public function toggle(string $key)
    {
        $allowed = ['registration', 'attendance_day1', 'attendance_day2', 'attendance_day3'];

        if (!in_array($key, $allowed)) abort(403);

        $setting = \App\Models\Setting::firstOrCreate(
            ['key' => $key],
            ['value' => true]
        );

        $setting->update(['value' => !$setting->value]);

        return back()->with('admin_success', 'Setting updated!');
    }

    public function resendRegistrationEmail(Registration $registration)
    {
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

        return back()->with(
            $result['status'] === 'sent' ? 'admin_success' : 'admin_error',
            $result['status'] === 'sent'
                ? "Confirmation email resent to {$registration->email}."
                : "Failed to resend: {$result['error']}"
        );
    }

    public function resendAttendanceEmail(Attendance $attendance)
    {
        $registration = $attendance->registration;

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

        return back()->with(
            $result['status'] === 'sent' ? 'admin_success' : 'admin_error',
            $result['status'] === 'sent'
                ? "Confirmation email resent to {$registration->email}."
                : "Failed to resend: {$result['error']}"
        );
    }
}