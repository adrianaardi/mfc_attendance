<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Services\BrevoMailer;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $registrations = Registration::latest()->get();
        $day1 = Attendance::with('registration')->where('day', 1)->latest()->get();
        $day2 = Attendance::with('registration')->where('day', 2)->latest()->get();
        $day3 = Attendance::with('registration')->where('day', 3)->latest()->get();
        $twoDaysEmailStatus = $request->query('two_days_email_status');
        if ($twoDaysEmailStatus === 'unsent') {
            $twoDaysEmailStatus = 'pending';
        }

        $atLeastTwoDaysQuery = Registration::with('attendances')
            ->withCount('attendances')
            ->has('attendances', '>=', 2)
            ->orderByDesc('attendances_count')
            ->latest();

        if (in_array($twoDaysEmailStatus, ['pending', 'failed', 'sent'], true)) {
            $atLeastTwoDaysQuery->where('two_days_email_status', $twoDaysEmailStatus);
        }

        $atLeastTwoDays = $atLeastTwoDaysQuery->get();

        $settings = [
            'registration'    => \App\Models\Setting::isEnabled('registration'),
            'attendance_day1' => \App\Models\Setting::isEnabled('attendance_day1'),
            'attendance_day2' => \App\Models\Setting::isEnabled('attendance_day2'),
            'attendance_day3' => \App\Models\Setting::isEnabled('attendance_day3'),
        ];

        return view('admin', compact('registrations', 'day1', 'day2', 'day3', 'atLeastTwoDays', 'settings', 'twoDaysEmailStatus'));
    }

    public function sendTwoDaysEmails(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('admin_error', 'No records selected for sending email.');
        }

        $registrations = Registration::withCount('attendances')
            ->whereIn('id', $ids)
            ->has('attendances', '>=', 2)
            ->get();

        if ($registrations->isEmpty()) {
            return back()->with('admin_error', 'No valid recipients found for 2+ days email.');
        }

        $sentCount = 0;
        $failedCount = 0;

        foreach ($registrations as $registration) {
            $attachment = $this->twoDaysCertificateAttachment($registration);

            $result = BrevoMailer::send(
                $registration->email,
                $registration->name,
                'MFC 2026 - Digital Certificate of Attendance',
                view('emails.two-days-achievement', compact('registration'))->render(),
                [$attachment]
            );

            $registration->update([
                'two_days_email_status' => $result['status'],
                'two_days_email_error'  => $result['error'],
            ]);

            if ($result['status'] === 'sent') {
                $sentCount++;
            } else {
                $failedCount++;
            }
        }

        $message = "2+ days email process completed. Sent: {$sentCount}";
        if ($failedCount > 0) {
            $message .= ", Failed: {$failedCount}";
        }

        return back()->with($failedCount > 0 ? 'admin_error' : 'admin_success', $message);
    }

    private function twoDaysCertificateAttachment(Registration $registration): array
    {
        try {
            $pdfContent = Pdf::loadView('certificates.two-days', [
                'registration' => $registration,
            ])->setPaper('a4', 'landscape')->output();
        } catch (\Throwable $e) {
            $pdfContent = $this->emptyPdfContent();
        }

        return [
            'name' => 'MFC_digital_certificate_' . $registration->id . '.pdf',
            'content' => base64_encode($pdfContent),
        ];
    }

    private function emptyPdfContent(): string
    {
        return <<<'PDF'
%PDF-1.4
1 0 obj
<< /Type /Catalog /Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages /Kids [3 0 R] /Count 1 >>
endobj
3 0 obj
<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R >>
endobj
4 0 obj
<< /Length 0 >>
stream

endstream
endobj
xref
0 5
0000000000 65535 f 
0000000009 00000 n 
0000000058 00000 n 
0000000115 00000 n 
0000000202 00000 n 
trailer
<< /Root 1 0 R /Size 5 >>
startxref
251
%%EOF
PDF;
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