<?php

use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tenho-tweet', [TwitterController::class, 'tweet']);
Route::get('/tenho-react', [TwitterController::class, 'react']);
