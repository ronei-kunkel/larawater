<?php

use Illuminate\Support\Facades\Route;
use Larawater\Common\Infra\Middleware\AuthMiddleware;
use Larawater\Module\Access\Infra\Controller\UserAccessController;
use Larawater\Module\Drink\Infra\Controller\UserDrinkController;
use Larawater\Module\Register\Infra\Controller\UserRegisterController;

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
   * 200 - {"token": :jwt}
   * 401 - {"error": "Wrong credentials"}
   */
  Route::post('/access', UserAccessController::class);

  Route::middleware(AuthMiddleware::class)->group(function () {

    /**
     * 200 - {
     *   "user": {
     *       "id": :id,
     *       "name": :name,
     *       "drink_counter": :counter
     *     }
     *   }
     * 
     * 400 - {"error": "Missing 'Authorization' header"}
     *
     * 401 - {"error": "Invalid token"}
     *
     * 500 - {"status": "Error"}
     */
    Route::post('/drink', UserDrinkController::class);
  });
});