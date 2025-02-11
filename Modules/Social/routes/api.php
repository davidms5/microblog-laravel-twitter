<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Social\App\Http\Controllers\SocialController;

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
    Route::prefix("social")->group( function () {
        Route::controller(SocialController::class)->group(function () {
            Route::POST("tweet", "createTweet")->name("v1.social.tweet");

            Route::POST("follow", "follow")->name("v1.social.follow");
            Route::POST("unfollow", "unfollow")->name("v1.social.unfollow");
        });
    });
});
