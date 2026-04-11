<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\RenewalController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified', 'ensureActive'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('clients', ClientController::class)->middleware('checkModule:access_clients');
    Route::resource('queries', QueryController::class)->middleware('checkModule:access_queries');
    Route::resource('claims', ClaimController::class)->middleware('checkModule:access_claims');
    Route::resource('renewals', \App\Http\Controllers\RenewalController::class)->middleware('checkModule:access_renewals');
    Route::resource('staff', \App\Http\Controllers\StaffController::class);

    // Trash Bin Routes
    Route::get('/trash', [\App\Http\Controllers\TrashController::class, 'index'])->name('trash.index');
    Route::post('/trash/{type}/{id}/restore', [\App\Http\Controllers\TrashController::class, 'restore'])->name('trash.restore');
    Route::delete('/trash/{type}/{id}/force', [\App\Http\Controllers\TrashController::class, 'forceDelete'])->name('trash.force-delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
