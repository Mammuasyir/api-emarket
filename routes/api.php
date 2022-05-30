<?php

use App\Http\Controllers\API\AuthController;
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

//Laravel 9
Route::controller(AuthController::class)->group(function () {
    // Route::get('/tes', 'regis');
    Route::post('/regis', 'regis');
    Route::post('/login', 'login');
});

//Laravel 8
// Route::post('/regis', [AuthController::class, 'regis']);
// Route::post('/login', [AuthController::class, 'login']);
