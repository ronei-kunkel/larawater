<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  echo('<h1>Doc in development</h1><br><p>Try the collection for now: <a href="https://github.com/ronei-kunkel/larawater/blob/main/collection/larawater.postman_collection.json">Link</a></p>');
});

