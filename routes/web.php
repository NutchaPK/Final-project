<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\UserinformationController;
use App\Http\Controllers\UsernutrientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

//View
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
Route::middleware(['auth:sanctum', 'verified'])->get('/appointment', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointment');
Route::middleware(['auth:sanctum', 'verified'])->get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

//API
Route::resource('userinformations',UserinformationController::class);
Route::resource('usernutrients',UsernutrientController::class);
Route::resource('meals',MealController::class);
Route::resource('appointments',AppointmentController::class);