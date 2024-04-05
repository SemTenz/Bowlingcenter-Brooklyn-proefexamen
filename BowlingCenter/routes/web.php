<?php

use App\Http\Controllers\employeecontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'], '1')->name('admin.')->prefix('admin')->group(function () {
    Route::get('index', [employeecontroller::class, 'index'])->name('index');
    Route::get(('/employee/{id}/edit'), [employeecontroller::class, 'edit']);
    Route::put('/employee/{id}', [employeecontroller::class, 'update']);
    Route::resource('/medewerkers', employeecontroller::class);
});

Route::middleware(['auth'], '2')->name('admin.')->prefix('admin')->group(function () {
    Route::get('index', [employeecontroller::class, 'index'])->name('index');
    Route::resource('/medewerkers', employeecontroller::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__ . '/auth.php';
