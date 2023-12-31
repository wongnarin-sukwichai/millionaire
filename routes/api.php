<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\EditTopicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', UserController::class);
    Route::resource('group', GroupController::class);
    Route::resource('topic', TopicController::class);
    Route::resource('shop', ShopController::class);
    Route::resource('editTopic', EditTopicController::class);
});


