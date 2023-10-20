<?php

use Illuminate\Support\Facades\Route;
use Larawater\Documentation\Infra\Controller\ShowDocumentationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| WHEN HAVE REDIRECT, NEED TO SET THE PROJECT PATH
| BECAUSE THE REQUEST FROM SERVER, THEN NEED TO SPECIFICATE THE TARGET
|
| ITS NEEDED BECAUSE THE ARCHITECTURE OF INFRA (MULTIPLE PROJECTS SEGREGATED IN SUBFOLDERS)
|
| Route::redirect('', '/larawater');
|
*/

Route::redirect('', '/larawater/documentation/v1');


// Route::redirect('', 'documentation');
// Route::get('documentation', ShowDocumentationController::class);

Route::get('documentation/{version}', ShowDocumentationController::class);
