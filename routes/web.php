\<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\PageController::class, 'index'])->name('home');
    Route::resource('user', \App\Http\Controllers\UserController::class)
        ->except(['show', 'edit', 'create'])
        ->middleware(['role:admin']);
  Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
});
    Route::get('profile', [\App\Http\Controllers\PageController::class, 'profile'])
        ->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\PageController::class, 'profileUpdate'])
        ->name('profile.update');
    Route::put('profile/deactivate', [\App\Http\Controllers\PageController::class, 'deactivate'])
        ->name('profile.deactivate')
        ->middleware(['role:staff']);

    Route::get('settings', [\App\Http\Controllers\PageController::class, 'settings'])
        ->name('settings.show')
        ->middleware(['role:admin']);
    Route::put('settings', [\App\Http\Controllers\PageController::class, 'settingsUpdate'])
        ->name('settings.update')
        ->middleware(['role:admin']);

    Route::delete('attachment', [\App\Http\Controllers\PageController::class, 'removeAttachment'])
        ->name('ent.destroy');

    Route::prefix('SOP')->as('SOP.')->group(function () {
        Route::resource('Sertifikasi_TI', \App\Http\Controllers\Sertifikasi_TIController::class);
        Route::resource('Administrasi_Keuangan', \App\Http\Controllers\Administrasi_KeuanganController::class);
        Route::resource('Manajemen_Mutu', \App\Http\Controllers\Manajemen_MutuController::class);
        Route::resource('Marketing', \App\Http\Controllers\MarketingController::class);


    });
    Route::prefix('Output')->as('Output.')->group(function () {
        Route::resource('Sertifikasi_TI', \App\Http\Controllers\OutputSertifikasi_TIController::class);
        Route::resource('Administrasi_Keuangan', \App\Http\Controllers\OutputAdministrasi_KeuanganController::class);
        Route::resource('Manajemen_Mutu', \App\Http\Controllers\OutputManajemen_MutuController::class);
        Route::resource('Marketing', \App\Http\Controllers\OutputMarketingController::class);

    });
    Route::prefix('reference')->as('reference.')->middleware(['role:admin'])->group(function () {
        Route::resource('classification', \App\Http\Controllers\ClassificationController::class)->except(['show', 'create', 'edit']);
        Route::resource('status', \App\Http\Controllers\LetterStatusController::class)->except(['show', 'create', 'edit']);
    });

});
