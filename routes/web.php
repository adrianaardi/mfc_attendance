<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
// Main event site
Route::get('/', function () {
    return view('index');
});

// Registration
Route::get('/event-register', [RegistrationController::class, 'show']);
Route::post('/event-register', [RegistrationController::class, 'store']);

// Attendance
Route::post('/attendance', [AttendanceController::class, 'store']);

// Admin - protected
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/export/{day}', [AdminController::class, 'export']);
    Route::delete('/admin/registrations', [AdminController::class, 'deleteRegistrations']);
Route::delete('/admin/attendances', [AdminController::class, 'deleteAttendances']);
});

Route::get('/create-admin', function () {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@sarawak.gov.my',
        'password' => bcrypt('password123'),
    ]);
    return 'User created!';
});

require __DIR__.'/auth.php';