<?php

use App\Http\Controllers\Apis\PublicData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['namespace' => 'App\Http\Controllers\Apis'], function () {

    //
    Route::post('/register', 'AuthCon@register');
    Route::post('/login', 'AuthCon@login');

    //
    Route::prefix('public')->group(function () {
        Route::get('/todos', 'PublicData@index');
    });

    //
    Route::middleware('auth:sanctum')->prefix('user')->group(function () {
        Route::post('/logout', 'AuthCon@logout');
    });
});
