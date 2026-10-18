<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    // APIが動いているか確認する
    return response()->json([
        'status' => 'ok',
        'message' => 'Mother Calendar API is running',
    ]);
});

Route::get('/user', function (Request $request) {
    // ログイン中のユーザーを取得する
    return $request->user();
})->middleware('auth:sanctum');

// 予定一覧を取得する
Route::get('/families/{family}/events', [EventController::class, 'index']);


// 予定を追加する
Route::post('/families/{family}/events', [EventController::class, 'store']);
