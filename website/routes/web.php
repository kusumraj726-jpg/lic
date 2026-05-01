<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/get-started', function () {
    return view('auth.service-selection');
})->name('get-started');

// Guest checkout for new users (sign-up flow)
Route::post('/get-started/checkout', [\App\Http\Controllers\BillingController::class, 'guestCheckout'])->middleware('noCache')->name('get.started.checkout');
Route::post('/get-started/verify', [\App\Http\Controllers\BillingController::class, 'guestVerify'])->middleware('noCache')->name('get.started.verify');

Route::get('/lifecycle', function () {
    return view('lifecycle');
})->name('lifecycle');

Route::get('/services/web-development', function () {
    return view('services.web-development');
})->name('services.web-development');

Route::get('/services/insurance-erp', function () {
    return view('services.insurance-erp');
})->name('services.insurance-erp');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/consultation', [\App\Http\Controllers\StudioInquiryController::class, 'store'])->name('consultation.store');

Route::get('/force-login', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('force-login');

require __DIR__ . '/auth.php';
