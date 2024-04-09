<?php

use App\Http\Controllers\employeecontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UitslagenController;
use App\Http\Controllers\SpelersController;
use App\Models\Reservation;

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
    Route::get('/employee/index', [employeecontroller::class, 'index'])->name('index');
    Route::get('/employee/{id}/edit', [employeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/store', [employeecontroller::class, 'store'])->name('employee.store');
    Route::put('/employee/{id}', [employeecontroller::class, 'update'])->name('employee.update');
    Route::delete('/employee/{id}', [employeecontroller::class, 'destroy'])->name('employee.delete');
    Route::get('/employee/create', [employeecontroller::class, 'create'])->name('employee.create');
    Route::get('index', [employeecontroller::class, 'index'])->name('index');
    Route::resource('/medewerkers', employeecontroller::class);
});

Route::middleware(['auth'], '2')->name('admin.')->prefix('admin')->group(function () {
    Route::get('index', [employeecontroller::class, 'index'])->name('index');
    Route::resource('/medewerkers', employeecontroller::class);
});

Route::middleware(['auth'])->name('reservations.')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('create');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('store');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth'])->name('scores.')->group(function () {
    Route::get('/scores/create', [ScoreController::class, 'create'])->name('create');
    Route::post('/scores/store', [ScoreController::class, 'store'])->name('store');
    Route::get('/scores/{score}', [ScoreController::class, 'show'])->name('show');
});

Route::middleware(['auth'])->name('uitslagen.')->group(function () {
    Route::get('/uitslagen', [UitslagenController::class, 'index'])->name('index');
    Route::post('/uitslagen/store', [UitslagenController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->name('speler.')->group(function () {
    Route::get('/speler', [SpelersController::class, 'index'])->name('index');
    Route::get('/speler/{id}/edit', [SpelersController::class, 'edit'])->name('edit');
    Route::put('/speler/{id}', [SpelersController::class, 'update'])->name('update');
});






require __DIR__ . '/auth.php';
