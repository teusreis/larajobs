<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ApplicationController;

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

/**
 * Site Routes
 */
Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/myApplications', [ApplicationController::class, 'myApplications'])
    ->middleware('auth')
    ->name('myApplications');

/**
 *  Dashboard Routes
 */
Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'isNormalUser']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});

/**
 * Company Routes
 */
Route::group(['prefix' => '/company', 'middleware' => ['auth']], function () {
    Route::get('/jobs', [CompanyController::class, 'jobs'])
        ->middleware('isCompany')
        ->name('company.jobs');

    Route::get('/{job}/application', [ApplicationController::class, 'index'])
        ->middleware('isNormalUser')
        ->name('company.job.application');
});

/**
 * Job Routes
 */
Route::group(['prefix' => '/job', 'middleware' => [], 'as' => 'job.'], function () {
    Route::get('/', [JobController::class, 'index'])->name('index');

    Route::middleware(['auth', 'isCompany'])->group(function () {
        Route::get('/create', [JobController::class, 'create'])->name('crate');
        Route::post('/', [JobController::class, 'store'])->name('store');
        Route::get('/{job}/edit', [JobController::class, 'edit'])->name('edit');
        Route::put('/{job}', [JobController::class, 'update'])->name('update');
        Route::patch('/{job}', [JobController::class, 'toggle'])->name('toggle');
    });

    Route::get('/{job}', [JobController::class, 'show'])->name('show');
});

/**
 * Resume Routes
 */
Route::group(['prefix' => '/resume', 'as' => 'resume.', 'middleware' => ['auth']], function () {

    Route::middleware(['isNormalUser'])->group(function () {
        Route::get('/', [ResumeController::class, 'index'])->name('index');
        Route::get('/create', [ResumeController::class, 'create'])->name('create');
        Route::post('/', [ResumeController::class, 'store'])->name('store');
        Route::get('/{resume}/edit', [ResumeController::class, 'edit'])->name('edit');
        Route::put('/{resume}', [ResumeController::class, 'update'])->name('update');
        Route::delete('/{resume}', [ResumeController::class, 'destroy'])->name('destroy');
    });

    Route::get('/{resume}', [ResumeController::class, 'show'])->name('show')->middleware('isCompany');
});

/**
 * Job users Routes
 */
Route::group(['prefix' => '/apply', 'middleware' => ['auth', 'isNormalUser']], function () {
    Route::post('/{job}', [JobUserController::class, 'store'])->name('job.apply');
});

/**
 * Invites Routes
 */
Route::group(['prefix' => '/invite', 'as' => 'invite.', 'middleware' => ['auth']], function () {
    Route::get('/', [InviteController::class, 'index'])->name('index')->middleware('isNormalUser');
    Route::post('/', [InviteController::class, 'store'])->name('create')->middleware('isCompany');
});

require __DIR__ . '/auth.php';
