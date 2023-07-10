<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PochtaController;
use Illuminate\Database\Connectors\PostgresConnector;
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

// Auth api
Route::post('/login', [AuthController::class, 'login']);

// Pochta uchun api lar
Route::post('pochta', [PochtaController::class, 'store']);
Route::post('pochta/check', [PochtaController::class, 'checkStatus']);

// Admin api lari
Route::prefix('admin')->group(function ()
{
    Route::group(['middleware' => 'auth:sanctum'], function ()
    {
        Route::get('/pochta', [PochtaController::class, 'index']);
        Route::get('/pochta/{id}', [PochtaController::class, 'show']);
        Route::post('pochta/check/{id}', [PochtaController::class, 'checkPost']);
    });
});