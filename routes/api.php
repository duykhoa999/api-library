<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ReaderController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/details', [UserController::class, 'details']);
});
Route::get('/users', [UserController::class, 'index']);

//Book
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

//Reader
    Route::get('/readers', [ReaderController::class, 'index']);
    Route::get('/readers/{id}', [ReaderController::class, 'show']);
    Route::post('/readers', [ReaderController::class, 'store']);
    Route::put('/readers/{id}', [ReaderController::class, 'update']);
    Route::delete('/readers/{id}', [ReaderController::class, 'destroy']);

//Author
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

//Category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
