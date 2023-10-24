<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LugarController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

/*
Route::get('/lugar', function () {
    return view('lugar.index');
});

Route::get('/lugar/create', [LugarController::class, 'create']);
*/

Route::resource('lugar', LugarController::class);
//borra la accion register, ya que mi Crud solo permite una cuenta Admin
Auth::routes();

Route::get('/home', [LugarController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [LugarController::class, 'index'])->name('home');
});
