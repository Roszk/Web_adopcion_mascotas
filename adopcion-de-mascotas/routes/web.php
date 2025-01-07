<?php

use App\Http\Controllers\PetsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HappyEndingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('pets', PetsController::class);
Route::resource('events', EventsController::class);
Route::resource('happy-endings', HappyEndingsController::class);
