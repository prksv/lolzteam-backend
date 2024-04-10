<?php

use App\Http\Controllers\Api\ArticleCommentController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
    });
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::prefix('{article}')->group(function () {
        Route::get('/', [ArticleController::class, 'show']);
        Route::post('comments', [ArticleCommentController::class, 'store'])
            ->middleware('auth:sanctum');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
