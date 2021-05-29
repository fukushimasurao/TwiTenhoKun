<?php

use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/twi_auto_Bot', [TwitterController::class, 'tweet']);
