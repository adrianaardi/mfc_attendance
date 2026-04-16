<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Hash;
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
});

Route::get('/setup-admin', function () {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin.forest@sarawak.gov.my',
        'password' => Hash::make('123456789'),
    ]);
    return 'Admin created!';
});

require __DIR__.'/auth.php';