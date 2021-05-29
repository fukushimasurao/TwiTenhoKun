<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TwitterController;

Route::get('/twi_auto_Bot', [TwitterController::class, 'tweet']);
