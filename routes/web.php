<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\Projects::class,'index']);
Auth::routes();
Route::get('/home',[App\Http\Controllers\Projects::class,'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/projects/{userId}/{projectId}', [App\Http\Controllers\proekti::class, 'show'])->middleware('auth', 'ProjectAccess');
Route::middleware(['auth', 'project.access'])->group(function () {
    Route::get('/projects/{userId}/{projectId}', [App\Http\Controllers\proekti::class, 'show'])->name('projects.show');
});
Route::get('/settings',[App\Http\Controllers\LoginLogs::class,'index']);
Route::get('/redeem-voucher/{code}', [App\Http\Controllers\VoucherController::class,'redeemVoucher'])->name('voucher.check');
Route::get('/redeem-voucher/{code}/debugMode', [App\Http\Controllers\VoucherController::class,'debugMode']);
Route::get('/balance', [App\Http\Controllers\VoucherController::class,'index'])->middleware('auth')->name('balance.check');
