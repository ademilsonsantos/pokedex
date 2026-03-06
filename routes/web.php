<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [PokedexController::class, 'index'])->name('pokedex.index');

    Route::resource('permission', PermissionController::class);;
});
