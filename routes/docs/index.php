<?php

use App\Http\Controllers\Api\ApiDocsController;
use Illuminate\Support\Facades\Route;

Route::get('/docs', [ApiDocsController::class, 'index']);
Route::get('/docs/swagger', [ApiDocsController::class, 'getData']);
