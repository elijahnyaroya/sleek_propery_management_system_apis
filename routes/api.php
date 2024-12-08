<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertyController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/properties', [PropertyController::class, 'createNewProperty']); // Create a new property
Route::patch('/properties/{id}', [PropertyController::class, 'updateProperty']); // Update a property details
Route::delete('/properties/{id}', [PropertyController::class, 'destroyProperty']); // Delete a property
