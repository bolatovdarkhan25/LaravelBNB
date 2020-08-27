<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bookables', 'Api\BookablesController')->except(['create']);
Route::get('bookables/{bookable}/availability', 'Api\BookableAvailabilityController')
    ->name('bookable.availability.show');

Route::get('bookables/{bookable}/reviews', 'Api\BookableReviewsController')
    ->name('bookable.reviews.index');

Route::apiResource('reviews', 'Api\ReviewsController')->only(['show']);

Route::get('booking-by-review/{reviewKey}', 'Api\BookingByReviewController');
