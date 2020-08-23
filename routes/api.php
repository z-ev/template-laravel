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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/unauthorized', function (Request $request) {
    return response()->json([
        'message' => 'Unauthorized.',
        'errors' => ['auth' => 'Unauthorized.']
    ], 401);
})->name('unauthorized');

Route::prefix('auth')->namespace('Auth')->group(function() {
    Route::post('register', 'RegisterController')->name('register');
    Route::post('token', 'TokenController')->name('token');

    // Get Listing
    Route::get('routes', 'ListingController@routes')->middleware(['auth:sanctum']);
    Route::get('roles', 'ListingController@roles')->middleware(['auth:sanctum']);
    Route::get('permissions', 'ListingController@permissions')->middleware(['auth:sanctum']);
});

Route::prefix('dashboard')
    ->namespace('Dashboard')
    ->middleware(['auth:sanctum', 'check-prs'])
    ->group(function() {
        Route::apiResources([

            // System
            'users' => 'UserController',
            'user-agents' => 'UserAgentController',
        ]);
    });
