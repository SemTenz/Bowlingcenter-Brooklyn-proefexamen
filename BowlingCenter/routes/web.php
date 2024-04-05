<?php

use App\Http\Controllers\employeecontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('/medewerkers', employeecontroller::class);
});

Route::middleware(['auth'], '2')->name('admin.')->prefix('admin')->group(function () {
    Route::get('index', [employeecontroller::class, 'index'])->name('index');
    Route::resource('/medewerkers', employeecontroller::class);
});
require __DIR__ . '/auth.php';
