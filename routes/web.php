<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnauthorizedController;

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

Auth::routes();

Route::get('/unauthorized', [UnauthorizedController::class, 'index'])->name('unauthorized');

Route::middleware(['auth', AdminRole::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function() {

    });
});

Route::middleware(['auth', UserRole::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/dashboard', [HomeController::class, 'userIndex'])->name('dashboard');
    });
});