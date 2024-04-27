<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnauthorizedController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\UserRole;
use App\Http\Middleware\AdminRole;
use App\Http\Middleware\superAdmin;

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

Route::middleware(['auth', superAdmin::class])->group(function() {
    Route::prefix('superadmin')->name('superadmin.')->group(function() {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        
        Route::resource('/contestant', ContestantController::class);
        Route::get('/vote/{contestant}', [ContestantController::class, 'vote'])
            ->name('vote');

        Route::get('/vote/get/{contestant}', [VoteController::class, 'getVotes'])
            ->name('vote.get');

        Route::POST('/vote/yes/{contestant}', [VoteController::class, 'yesVote'])
            ->name('vote.yes');
        Route::POST('/vote/no/{contestant}', [VoteController::class, 'noVote'])
            ->name('vote.no');
        Route::resource('vote', VoteController::class);
    });
});

Route::middleware(['auth', AdminRole::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        
        Route::resource('/contestant', ContestantController::class);
        Route::get('/vote/{contestant}', [ContestantController::class, 'vote'])
            ->name('vote');

        Route::get('/vote/get/{contestant}', [VoteController::class, 'getVotes'])
            ->name('vote.get');

        Route::POST('/vote/yes/{contestant}', [VoteController::class, 'yesVote'])
            ->name('vote.yes');
        Route::POST('/vote/no/{contestant}', [VoteController::class, 'noVote'])
            ->name('vote.no');
        Route::resource('vote', VoteController::class);
    });
});

Route::middleware(['auth', UserRole::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::resource('/contestant', ContestantController::class);
        Route::get('/vote/get/{contestant}', [VoteController::class, 'getVotes'])
        ->name('vote.get');
    });
});