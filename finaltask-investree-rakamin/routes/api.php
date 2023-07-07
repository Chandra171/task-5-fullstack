<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    ROute::apiResource('post', PostController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
// Route::resource('article', ArticleController::class)->middleware(['auth:passport']);

// Route::group(['middleware' => ['auth:Passport']], function () {
//     // route::get('/profile', [AuthController::class, 'profile']);
//     route::post('/logout', [AuthController::class, 'logout']);
//     Route::resource('article', ArticleController::class);
// });

// Route::middleware('auth:api')->group(function(){
//     route::get('/profile', [AuthController::class, 'profile']);
//     route::get('/logout', [AuthController::class, 'logout']);
// });