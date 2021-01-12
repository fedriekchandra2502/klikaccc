<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POController;

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

Route::get('/po', [POController::class, 'showAllPO']);
Route::post('po/create', [POController::class, 'createPO']);
Route::put('po/update/{id}', [POController::class, 'updatePO']);
Route::delete('po/delete/{id}', [POController::class, 'deletePO']);
