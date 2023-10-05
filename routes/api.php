<?php

use Illuminate\Support\Facades\Route;
use Larawater\Register\Infra\Controller\UserRegisterController;
use Larawater\Access\Infra\Controller\UserAccessController;

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
  /**
   * 200 - {}
   * 500 - {"status": "Error"}
   */
  Route::post('/register', UserRegisterController::class);

  /**
   * 200 - {"status": "Authenticated"}
   * 500 - {"status": "Error"}
   */
  Route::post('/access', UserAccessController::class);
});