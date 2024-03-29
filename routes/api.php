<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MyAppController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::post('/images/add',[ImageController::class, 'add']);
Route::post('/myapps/add',[MyAppController::class, 'add']);
// Route::post('/image/imageCounter',[ImageController::class,'imageCounter']);
// Route::get('/images/download/{id}', 'ImageController@download');

Route::middleware('api')->group(function () {
    Route::get('/images/download/{id}', [ImageController::class, 'download']);
});

Route::get('/myapps/all',[MyAppController::class, 'all']);

// Route::get('/images/all',[ImageController::class, 'all']);
