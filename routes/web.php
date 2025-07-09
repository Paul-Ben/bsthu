<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

    // Application routes
    // Route::get('/', function () { return view('home'); })->name('home');

// Public application routes
Route::controller(ApplicationController::class)->group(function() {
    Route::get('/apply', 'create')->name('applications.public.create');
    Route::post('/apply', 'store')->name('applications.public.store');
});

// Authenticated application routes
Route::resource('applications', ApplicationController::class)->middleware(['auth']);
    Route::get('applications/{application}/download', [ApplicationController::class, 'downloadDocument'])->name('applications.download');
Route::get('/applications/{application}/confirmation', [ApplicationController::class, 'confirmation'])
    ->name('applications.confirmation');
    // Admission routes
    Route::prefix('admissions')->group(function() {
        Route::get('review', [AdmissionController::class, 'filter'])->name('admissions.review');
        Route::post('{application}/create-student', [AdmissionController::class, 'createStudent'])->name('admissions.create-student');
        Route::get('{admission}/offer-letter', [AdmissionController::class, 'generateOfferLetter'])->name('admissions.offer-letter');
    });Route::delete('/admissions/{admission}/transfer', [AdmissionController::class, 'transfer'])
    ->name('admissions.transfer');
    Route::resource('admissions', AdmissionController::class)->except(['create', 'edit']);
// Route::post('/admissions/bulk', ...);
// Route::post('/admissions/{admission}/payment', ...);
});

require __DIR__.'/auth.php';
