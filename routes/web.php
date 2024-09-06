<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'ListForWeb']);
Route::post('/monitor', [SiteController::class, 'Add']);
Route::get('/monitor/{id}/delete', [SiteController::class, 'Delete']);

