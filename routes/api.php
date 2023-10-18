<?php

use Illuminate\Support\Facades\Route;
use Larawater\Common\Infra\Middleware\AuthMiddleware;
use Larawater\Documentation\Infra\Controller\RawDocumentationController;
use Larawater\Module\Auth\Infra\Controller\UserAuthController;
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

Route::get('documentation/{version}', RawDocumentationController::class);

Route::prefix('v1')->group(function () {

  /**
   * 200 - {"token": "Bearer xxx.xxx.xxx"}
   * 400 - {"error": "The email 'xxx@xxx.com' has an invalid format"}
   * 401 - {"error": "Wrong credentials. Try again or create an account instead if you don't have one"}
   * 500 - {"error": "Token cannot generate now. Try again later"}
   */
  Route::post('/auth', UserAuthController::class);

  Route::prefix('user')->group(function () {

    /**
     * 201 - {"message": "Created"}
     * 400 - {"error: "The email value \'{value}\' has an invalid format"}
     * 400 - {"error: "Generic temporary error for password"}
     * 500 - {"error: "User cannot created"}
     */
    Route::post('/', UserRegisterController::class);

    /**
     * 400 - {"error": "Missing 'Authorization' header"}
     * 401 - {"error": "Invalid token"}
     */
    Route::middleware([AuthMiddleware::class])->group(function () {

      /**
       * 200 - {
       *   "user": {
       *       "id": xxx,
       *       "name": "xxx",
       *       "drink_counter": xxx
       *     }
       *   }
       * 400 - {"error": "Only positive drinks are allowed"}
       * 404 - {"error": "User not found"}
       * 500 - {"error": "Cannot update user drink counter"}
       */
      Route::post('/drink', UserDrinkController::class);
    });
  });
});