<?php

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

        Route::get('/todos', 'TodoCon@index');

        Route::post('/add-todo', 'TodoCon@addTodo');

        Route::put('/todo/{id}', 'TodoCon@updateTodo');

        Route::put('/todo-status/{id}', 'TodoCon@updateStatus');

        Route::post('/search-todo', 'TodoCon@searchTodo');

        Route::delete('/delete-todo/{id}', 'TodoCon@deleteTodo');

        Route::post('/logout', 'AuthCon@logout');
    });
});
