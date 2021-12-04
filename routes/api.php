<?php

use App\Http\Controllers\PostApiController;
use App\Http\Controllers\TransactionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('programs', App\Http\Controllers\API\ProgramController::class);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});


//another api with controller
Route::get('/posts', [PostApiController::class, 'index']);
Route::get('/posts/{post}', [PostApiController::class, 'show']);
Route::post('/posts', [PostApiController::class, 'store']);
Route::put('/posts/{post}', [PostApiController::class, 'update']);
Route::delete('/posts/{post}', [PostApiController::class, 'destroy']);

//Another api for table transactions
// Route::get('/transactions', [TransactionController::class, 'index']);
// Route::post('/transactions', [TransactionController::class, 'store']);
// Route::PUT('/transactions/{id}', [TransactionController::class, 'update']);
// Route::get('/transactions/{id}', [TransactionController::class, 'show']);
// Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

//api transactions diatas dpt dipersingkat karena menggunakan method default
Route::resource('/transactions', TransactionController::class);
