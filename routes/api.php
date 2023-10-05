<?php

use Illuminate\Support\Facades\Route;
use Larawater\Register\Infra\Controller\UserRegisterController;

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

Route::prefix('v1')->group(function () {
  Route::post('/register', UserRegisterController::class); // 200 or 500 with body '"status": "Error"'
  Route::post('/access', UserAccessController::class); // 200 or 500 with body '"status": "Error"'
});