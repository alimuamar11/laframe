<?php

use App\Models\Post;
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


//another api without controller
Route::get('/posts', function () {
    return Post::all();
});
Route::get('/posts/{post}', function (Post $post) {
    return Post::find($post);
});

Route::post('/posts', function () {
    request()->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    return Post::create([
        'title' => request('title'),
        'content' => request('content'),
    ]);
});

Route::put('/posts/{post}', function (Post $post) {
    request()->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $success = $post->update([
        'title' => request('title'),
        'content' => request('content'),
    ]);

    return [
        'success' => $success
    ];
});
Route::delete('/posts/{id}', function (Post $id) {
    $success = $id->delete();
    //same id,
    return [
        'success' => $success,
    ];
});
