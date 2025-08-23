<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FacilityController::class, 'index'])->name('dashboard');
    Route::get('facilities/export', [FacilityController::class, 'export'])->name('facilities.export');
    Route::resource('facilities', FacilityController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/facilities/export', [FacilityController::class, 'export'])->name('facilities.export');
});

require __DIR__ . '/auth.php';
