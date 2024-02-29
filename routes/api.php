<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\TasksController;


Route::prefix('tasks')->group(function(){
    Route::get('/', [TasksController::class, 'tasks']);
    Route::post('/', [TasksController::class, 'store']);
    Route::get('/{task_id}/history', [TasksController::class, 'history']);
    Route::post('/{task_id}', [TasksController::class, 'update']);
});

