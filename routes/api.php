<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/monitor', [SiteController::class, 'ListForAPI']);