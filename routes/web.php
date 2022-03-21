<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Admin routes
 */
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

/**
 * User routes
 */
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' =>'admin', 'middleware'=>['admin:admin']], function () {
    Route::get('/login',         [AdminController::class ,'loginForm'])->name('admin.login');
    Route::post('/login',        [AdminController::class ,'store'])->name('admin.login');
});

Route::get('/admin/logout', [AdminController::class ,'destroy'])->name('admin.logout');
Route::get('/admin/profile', [ ProfileController::class ,'profile'])->name('admin.profile');
Route::get('/admin/profile/edit', [ProfileController::class ,'edit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [ProfileController::class ,'store'])->name('admin.profile.store');
Route::get('/admin/change-password', [ProfileController::class ,'changePassword'])->name('admin.change.password');
Route::post('/admin/change-password', [ProfileController::class ,'updatePassword'])->name('update.change.password');
