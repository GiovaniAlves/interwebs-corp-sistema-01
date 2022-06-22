<?php

use App\Http\Controllers\Api\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/list-urls', [UrlController::class, 'index']);
