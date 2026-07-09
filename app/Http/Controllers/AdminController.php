<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use App\Services\ConfirmationMailer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $regSearch  = $request->input('reg_search');
        $day1Search = $request->input('day1_search');
        $day2Search = $request->input('day2_search');
        $day3Search = $request->input('day3_search');

        $registrations = Registration::when($regSearch, function ($q) use ($regSearch) {
                $q->where(function ($q2) use ($regSearch) {
                    $q2->where('name', 'like', "%{$regSearch}%")
                       ->orWhere('email', 'like', "%{$regSearch}%")
                       ->orWhere('phone', 'like', "%{$regSearch}%")
                       ->orWhere('agency', 'like', "%{$regSearch}%")
                       ->orWhere('designation', 'like', "%{$regSearch}%");
                });
            })
            ->latest()
            ->paginate(15, ['*'], 'reg_page')
            ->withQueryString();

        $day1 = $this->attendanceQuery(1, $day1Search)->paginate(15, ['*'], 'day1_page')->withQueryString();
        $day2 = $this->attendanceQuery(2, $day2Search)->paginate(15, ['*'], 'day2_page')->withQueryString();
        $day3 = $this->attendanceQuery(3, $day3Search)->paginate(15, ['*'], 'day3_page')->withQueryString();

        $settings = [
            'registration'    => \App\Models\Setting::isEnabled('registration'),
            'attendance_day1' => \App\Models\Setting::isEnabled('attendance_day1'),
            'attendance_day2' => \App\Models\Setting::isEnabled('attendance_day2'),
            'attendance_day3' => \App\Models\Setting::isEnabled('attendance_day3'),
        ];

        // Totals for the summary cards — independent of any search filter
        $counts = [
            'registrations' => Registration::count(),
            'day1'          => Attendance::where('day', 1)->count(),
            'day2'          => Attendance::where('day', 2)->count(),
            'day3'          => Attendance::where('day', 3)->count(),
        ];

        return view('admin', compact(
            'registrations', 'day1', 'day2', 'day3', 'settings', 'counts',
            'regSearch', 'day1Search', 'day2Search', 'day3Search'
        ));
    }

    protected function attendanceQuery(int $day, ?string $search)
    {
        return Attendance::with('registration')
            ->where('day', $day)
            ->when($search, function ($q) use ($search) {
                $q->whereHas('registration', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%")
                       ->orWhere('phone', 'like', "%{$search}%")
                       ->orWhere('agency', 'like', "%{$search}%")
                       ->orWhere('designation', 'like', "%{$search}%");
                });
            })
            ->latest();
    }

    public function export($day)
    {
        // unchanged from before
        if ($day === 'registrations') {
            $rows = Registration::latest()->get();

            $filename = 'registrations.csv';
            $headers = [
                'Content-Type'        => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function () use ($rows) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['No.', 'Full Name', 'Email', 'Phone', 'Designation', 'Agency / Organisation', 'Registered At', 'Email Status']);

                foreach ($rows as $i => $reg) {
                    fputcsv($file, [
                        $i + 1, $reg->name, $reg->email, $reg->phone, $reg->designation, $reg->agency,
                        $reg->created_at->format('d M Y, h:i A'), $reg->email_status,
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        $rows = Attendance::with('registration')->where('day', $day)->latest()->get();

        $filename = "attendance-day{$day}.csv";
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No.', 'Full Name', 'Email', 'Phone', 'Designation', 'Agency / Organisation', 'Check-in Time', 'Email Status']);

            foreach ($rows as $i => $att) {
                fputcsv($file, [
                    $i + 1, $att->registration->name, $att->registration->email, $att->registration->phone,
                    $att->registration->designation, $att->registration->agency,
                    \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A'), $att->email_status,
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

        $setting = \App\Models\Setting::firstOrCreate(['key' => $key], ['value' => true]);
        $setting->update(['value' => !$setting->value]);

        return back()->with('admin_success', 'Setting updated!');
    }

    public function resendRegistrationEmail(Registration $registration, ConfirmationMailer $mailer)
    {
        $result = $mailer->sendRegistrationEmail($registration);
        $registration->update(['email_status' => $result['status'], 'email_error' => $result['error']]);

        return back()->with(
            $result['status'] === 'sent' ? 'admin_success' : 'admin_error',
            $result['status'] === 'sent'
                ? "Confirmation email resent to {$registration->email}."
                : "Failed to resend email: {$result['error']}"
        );
    }

    public function resendAttendanceEmail(Attendance $attendance, ConfirmationMailer $mailer)
    {
        $result = $mailer->sendAttendanceEmail($attendance);
        $attendance->update(['email_status' => $result['status'], 'email_error' => $result['error']]);

        return back()->with(
            $result['status'] === 'sent' ? 'admin_success' : 'admin_error',
            $result['status'] === 'sent'
                ? "Confirmation email resent to {$attendance->registration->email}."
                : "Failed to resend email: {$result['error']}"
        );
    }
}