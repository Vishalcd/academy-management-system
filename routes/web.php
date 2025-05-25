<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;

// Logout Route
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// Student Profile
Route::middleware(['auth', 'role:student'])->group(function () {
    // Student Profile
    Route::get('/students/me', [StudentController::class, 'showMe'])->name('students.showMe');
});

// Employee Profile
Route::middleware(['auth', 'role:employee'])->group(function () {
    // Employee Profile
    Route::get('/employees/me', [EmployeeController::class, 'showMe'])->name('employees.showMe');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Home Route
    Route::get("/", [HomeController::class, "index"])->name('home');

    // Profile Route
    Route::get("/settings", [SettingController::class, "index"])->name('settings.index');
    Route::put("/settings", [SettingController::class, "update"])->name('settings.update');

    // Student Routes
    Route::resource("students", StudentController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
    Route::post("/students/{id}/deposit-fees", [StudentController::class, 'depositFee']);
    Route::post("/students/login", [StudentController::class, 'login']);

    // Employee Routes
    Route::resource("employees", EmployeeController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
    Route::post("/employees/{id}/deposit-salary", [EmployeeController::class, 'depositSalary']);

    // Expense Routes
    Route::resource("expenses", ExpenseController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
    Route::post('/auth/login', [LoginController::class, 'authenticate']);
});