<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Timeline\App\Http\Controllers\TimelineController;

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
    Route::prefix("timeline")->group( function () {
        Route::controller(TimelineController::class)->group(function () {
            Route::GET("show", "showTimeline")->name("v1.timeline.show");
        });
    });
});
