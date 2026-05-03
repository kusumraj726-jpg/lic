<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/artisan/clear-views', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'Views and cache cleared successfully at ' . now();
})->middleware('auth');

Route::get('/run-migrations-nexorabyte-99', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'mcauxstain@gmail.com'],
            [
                'name' => 'Super Admin',
                'company_name' => 'NexoraByte HQ',
                'password' => \Illuminate\Support\Facades\Hash::make('super s.s'),
                'role' => 'superadmin',
                'unique_id' => 'SUPER-001',
                'subscription_status' => 'active',
                'subscription_plan' => 'superadmin',
                'subscription_ends_at' => now()->addYears(10),
            ]
        );
        return "Migration & Account Setup Success! You can now login as: " . $user->email;
    } catch (\Exception $e) {
        return "Setup Error: " . $e->getMessage();
    }
})->middleware(['auth', 'superadmin']);

Route::middleware(['auth', 'superadmin', 'noDirect'])->prefix('nexorabyte-control')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.index');
    
    // Inquiries
    Route::get('/inquiries', [SuperAdminController::class, 'inquiries'])->name('superadmin.inquiries');
    Route::patch('/inquiries/{inquiry}', [SuperAdminController::class, 'inquiryUpdate'])->name('superadmin.inquiries.update');
    Route::delete('/inquiries/{inquiry}', [SuperAdminController::class, 'inquiryDestroy'])->name('superadmin.inquiries.destroy');
    
    // Financial Hub
    Route::get('/transactions', [SuperAdminController::class, 'transactions'])->name('superadmin.transactions');
    Route::get('/expenses', [SuperAdminController::class, 'expenses'])->name('superadmin.expenses');
    Route::post('/expenses', [SuperAdminController::class, 'storeExpense'])->name('superadmin.expenses.store');
    Route::delete('/expenses/{expense}', [SuperAdminController::class, 'deleteExpense'])->name('superadmin.expenses.delete');

    // Trash
    Route::get('/trash', [SuperAdminController::class, 'trash'])->name('superadmin.trash');
    Route::post('/trash/inquiry/{id}/restore', [SuperAdminController::class, 'inquiryRestore'])->name('superadmin.trash.restore');
    Route::delete('/trash/inquiry/{id}/force', [SuperAdminController::class, 'inquiryForceDelete'])->name('superadmin.trash.force');

    Route::get('/impersonate/{user}', [SuperAdminController::class, 'impersonate'])->name('superadmin.impersonate');

    Route::patch('/tenant/{user}/toggle', [SuperAdminController::class, 'toggleStatus'])->name('superadmin.toggle');

    // System Updates Management
    Route::get('/system-updates', [SuperAdminController::class, 'systemUpdates'])->name('superadmin.system-updates');
    Route::post('/system-updates', [SuperAdminController::class, 'systemUpdateStore'])->name('superadmin.system-updates.store');
    Route::delete('/system-updates/{update}', [SuperAdminController::class, 'systemUpdateDestroy'])->name('superadmin.system-updates.destroy');
});

Route::middleware(['auth'])->get('/nexorabyte-control/stop-impersonating', [SuperAdminController::class, 'stopImpersonating'])->name('superadmin.stop-impersonation');

Route::middleware(['auth', 'verified', 'ensureActive', 'noDirect'])->group(function () {
    Route::get('/billing', [\App\Http\Controllers\BillingController::class, 'index'])->name('billing.index');
    Route::post('/billing/checkout', [\App\Http\Controllers\BillingController::class, 'checkout'])->name('billing.checkout');
    Route::post('/billing/verify', [\App\Http\Controllers\BillingController::class, 'verify'])->name('billing.verify');
});

Route::middleware(['auth', 'verified', 'ensureActive', 'noDirect'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class)->middleware('checkModule:access_clients');
    Route::resource('queries', QueryController::class)->middleware('checkModule:access_queries');
    Route::resource('claims', ClaimController::class)->middleware('checkModule:access_claims');
    Route::resource('renewals', \App\Http\Controllers\RenewalController::class)->middleware('checkModule:access_renewals');
    Route::resource('commissions', \App\Http\Controllers\CommissionController::class)->middleware('checkModule:access_renewals');
    Route::get('/commissions-export', [\App\Http\Controllers\CommissionController::class, 'export'])->name('commissions.export');
    Route::post('/commissions/{commission}/received', [\App\Http\Controllers\CommissionController::class, 'markAsReceived'])->name('commissions.received');
    Route::resource('staff', \App\Http\Controllers\StaffController::class);

    Route::get('/trash', [\App\Http\Controllers\TrashController::class, 'index'])->name('trash.index');
    Route::post('/trash/{type}/{id}/restore', [\App\Http\Controllers\TrashController::class, 'restore'])->name('trash.restore');
    Route::delete('/trash/{type}/{id}/force', [\App\Http\Controllers\TrashController::class, 'forceDelete'])->name('trash.force-delete');
    Route::get('/api/search', [SearchController::class, 'search'])->name('api.search');
    Route::post('/dashboard/update-template', [DashboardController::class, 'updateTemplate'])->name('dashboard.update-template');

    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/branding', [\App\Http\Controllers\SettingsController::class, 'updateBranding'])->name('settings.branding.update');
    Route::post('/settings/commissions', [\App\Http\Controllers\SettingsController::class, 'updateCommissions'])->name('settings.commissions.update');
    Route::get('/settings/logs', [\App\Http\Controllers\SettingsController::class, 'logs'])->name('settings.logs');

    Route::get('/api/ai/brief', [\App\Http\Controllers\AiChatController::class, 'getBrief'])->name('api.ai.brief');
    Route::get('/api/chat/history', [\App\Http\Controllers\AiChatController::class, 'getHistory'])->name('api.chat.history');
    Route::post('/api/chat/send', [\App\Http\Controllers\AiChatController::class, 'sendMessage'])->name('api.chat.send');
    Route::post('/api/chat/tts', [\App\Http\Controllers\AiChatController::class, 'generateTts'])->name('api.chat.tts');
    Route::delete('/api/chat/session/{session}', [\App\Http\Controllers\AiChatController::class, 'deleteSession'])->name('api.chat.delete');
});

require __DIR__ . '/auth.php';
