<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'index')->middleware('auth');


Route::view('dashboard', 'index')->name('dashboard')->middleware('auth');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');




Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');


Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index')->middleware('auth');
Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create')->middleware('auth');
Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store')->middleware('auth');
Route::post('/cuti/{id}/approve', [CutiController::class, 'approve'])->name('cuti.approve')->middleware('auth');
Route::post('/cuti/{id}/reject', [CutiController::class, 'reject'])->name('cuti.reject')->middleware('auth');



Route::get('/buat-admin', [AuthController::class, 'seedAdmin']);
