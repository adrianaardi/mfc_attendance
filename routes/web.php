<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SlideController;

use Illuminate\Support\Facades\Artisan;

Route::get('/fix-storage', function () {
    try {
        Artisan::call('storage:link');
        return 'Storage symlink created successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Main event site
Route::get('/', function () {
    $settings = [
        'registration'    => \App\Models\Setting::isEnabled('registration'),
        'attendance_day1' => \App\Models\Setting::isEnabled('attendance_day1'),
        'attendance_day2' => \App\Models\Setting::isEnabled('attendance_day2'),
        'attendance_day3' => \App\Models\Setting::isEnabled('attendance_day3'),
    ];
    return view('index', compact('settings'));
});

// Registration
Route::get('/event-register', [RegistrationController::class, 'show']);
Route::post('/event-register', [RegistrationController::class, 'store']);

//poster
Route::view('/poster', 'poster');

// Attendance
Route::post('/attendance', [AttendanceController::class, 'store']);

// Admin - protected
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/export/{day}', [AdminController::class, 'export']);
    Route::delete('/admin/registrations', [AdminController::class, 'deleteRegistrations']);
    Route::delete('/admin/attendances', [AdminController::class, 'deleteAttendances']);
    Route::post('/admin/toggle/{key}', [AdminController::class, 'toggle']);

    // Slides management
    Route::get('/admin/slides', [SlideController::class, 'index']);
    Route::post('/admin/slides', [SlideController::class, 'store']);
    Route::delete('/admin/slides/{slide}', [SlideController::class, 'destroy']);
    Route::put('/admin/slides/{slide}', [SlideController::class, 'update']);
});

Route::post('/admin/toggle/{key}', [AdminController::class, 'toggle']);

Route::get('/', function () {
    $settings = [
        'registration'    => \App\Models\Setting::isEnabled('registration'),
        'attendance_day1' => \App\Models\Setting::isEnabled('attendance_day1'),
        'attendance_day2' => \App\Models\Setting::isEnabled('attendance_day2'),
        'attendance_day3' => \App\Models\Setting::isEnabled('attendance_day3'),
    ];

    // Find active day
    $activeDay = null;
    foreach ([1, 2, 3] as $day) {
        if ($settings['attendance_day' . $day]) {
            $activeDay = $day;
            break;
        }
    }

    // Find current activity
    $currentActivity = null;
    if ($activeDay) {
        $now = \Carbon\Carbon::now('Asia/Kuala_Lumpur')->format('H:i');
        $agenda = config('conference.agenda.' . $activeDay);

        foreach ($agenda as $item) {
            if ($now >= $item['time_start'] && $now < $item['time_end']) {
                $currentActivity = $item;
                break;
            }
        }
    }

$slides = \App\Models\Slide::orderBy('day')->orderBy('order')->orderBy('id')->get()->groupBy('day');

    return view('index', compact('settings', 'activeDay', 'currentActivity', 'slides'));
});

require __DIR__.'/auth.php';