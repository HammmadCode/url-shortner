<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShortUrlController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('test', [RedirectController::class, 'redirect'])->name('short.redirect');
    // Route::get('analytics/{id}', [AnalyticsController::class, 'showAnalytics'])->name('analytics.show');
    Route::get('shortCode/{shortCode}', [RedirectController::class, 'redirect'])->name('short.redirect');
    // Route::get('shortCode', [RedirectController::class, 'redirect'])->name('short.redirect');
    Route::post('shorturl', [ShortUrlController::class, 'store'])->name('shorturl.store');
    Route::get('analytics/{id}', [AnalyticsController::class, 'showAnalytics'])->name('analytics.show');

});


require __DIR__.'/auth.php';
