<?php

use Illuminate\Support\Facades\Route;
use Larawater\Documentation\Infra\Controller\ShowDocumentationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/documentation/v1');

Route::get('documentation/{version}', ShowDocumentationController::class);