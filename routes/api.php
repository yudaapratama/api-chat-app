<?php

use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('room', RoomController::class)->only(['index', 'store', 'destroy']);

    Route::get('chat/{room}', [ChatController::class, 'index']);
    Route::post('chat/{room}', [ChatController::class, 'store']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
