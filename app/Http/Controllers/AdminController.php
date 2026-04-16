<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->get();

        $day1 = Attendance::with('registration')->where('day', 1)->latest()->get();
        $day2 = Attendance::with('registration')->where('day', 2)->latest()->get();
        $day3 = Attendance::with('registration')->where('day', 3)->latest()->get();

        return view('admin', compact('registrations', 'day1', 'day2', 'day3'));
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
}