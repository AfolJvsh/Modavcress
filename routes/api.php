<?php

use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('tasks')->group(function () {
    Route::get('/', [TasksController::class, 'index']);
    Route::post('/', [TasksController::class, 'store']);
    Route::put('/{task}', [TasksController::class, 'update']);
    Route::delete('/{task}', [TasksController::class, 'destroy']);
});
Route::get('/', function(){ return 'API is working'; });