<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [StudentController::class, 'register']);
Route::post('login', [StudentController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [StudentController::class, 'profile']);
    Route::get('logout', [StudentController::class, 'logout']);
    // Route For Project Controller
    Route::post('create-project', [ProjectController::class, 'createProject']);
    Route::get('list-project', [ProjectController::class, 'listProject']);
    Route::get('single-project/{id}', [ProjectController::class, 'singleProject']);
    Route::delete('delete-project/{id}', [ProjectController::class, 'deleteProject']);
    Route::get('auth', [StudentController::class, 'isLoggedIn']);
});
