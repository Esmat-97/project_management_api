<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;


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




use App\Http\Controllers\AuthController;

// Route for user registration
Route::post('/register', [AuthController::class, 'register']);

// Route for user login
Route::post('/login', [AuthController::class, 'login']);

// Route for user logout (requires authentication middleware)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');






Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);




Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/current-project/{id}', [ProjectController::class, 'getCurrentProjectById']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/projects/select/{user_id}', [ProjectController::class, 'select']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);