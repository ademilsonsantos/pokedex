<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PokedexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('permission', PermissionController::class, ['except' => 'show']);
    Route::get('permission/search/{name?}', [PermissionController::class, 'search'])->name('permission.search');
    Route::resource('user', UserController::class, ['except' => 'show']);
    Route::get('user/search/{name?}', [UserController::class, 'search'])->name('user.search');

    Route::post('/pokemon/import', [PokedexController::class, 'import'])->name('pokemon.import')->middleware('throttle:10,1');
    Route::delete('/pokemon/destroy/{id}', [PokedexController::class, 'destroy'])->name('pokemon.destroy');
    Route::delete('/pokemon/favorite/{id}', [PokedexController::class, 'favorite'])->name('pokemon.favorite');
    Route::get('/pokemon/show/{id}', [PokedexController::class, 'show'])->name('pokemon.show');
    Route::get('/{name?}', [PokedexController::class, 'index'])->name('pokemon.index');
});
