<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Users\App\Http\Controllers\UsersController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::prefix('v1')->group(function () {
    Route::prefix("usuarios")->group( function () {
        Route::controller(UsersController::class)->group(function () {
            Route::GET("listar-usuarios", "listarUsuarios")->name("v1.usuarios.listar-usuarios");

            Route::POST("create-usuario", "storeUsuario")->name("v1.usuarios.create-usuario");
        });
    });
});
