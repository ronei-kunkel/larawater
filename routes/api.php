<?php

use Illuminate\Support\Facades\Route;
use Larawater\Authenticate\Infra\Middleware\Authenticate;
use Larawater\Drink\Infra\Controller\UserDrinkController;
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

  /**
   * 401 - {"status": "Unauthorized"}
   */
  Route::middleware(Authenticate::class)->group(function () {

    /**
     * 200 - {
     *   "status": "Drinked",
     *   "user": {
     *       "id": 1,
     *       "name": "xpto name",
     *       "drink_counter": :counter
     *     }
     *   }
     *
     * 500 - {"status": "Error"}
     */
    Route::post('/user/{id}/drink', UserDrinkController::class);
  });
});