<?php

use App\Http\Controllers\Api\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/urls-list', [UrlController::class, 'index']);
