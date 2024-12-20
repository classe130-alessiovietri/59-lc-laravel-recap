<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ContactController;

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

Route::name('api.')->group(function () {

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    // Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    /* OPPURE */

    Route::resource('posts', PostController::class)->only([
        'index',
        'show',
        'store'
    ]);

    Route::post('/new-contact', [ContactController::class, 'newContact'])->name('new-contact');

});
