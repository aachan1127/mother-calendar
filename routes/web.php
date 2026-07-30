<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'name' => 'Mother Calendar API',
        'status' => 'running',
    ]);
});
