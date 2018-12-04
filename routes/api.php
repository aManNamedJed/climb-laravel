<?php

use Illuminate\Http\Request;
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
    return $request->user()->with(['attempts.climb' => function($query) {
        $query->orderBy('created_at', 'desc');
    }])->first();
});

/**
 * Get a list of all climbs
 */
Route::middleware('auth:api')->get('/climbs', function (Request $request) {
    return App\Climb::all();
});

/**
 * Get a climb by its ID
 */
Route::middleware('auth:api')->get('/climbs/{id}', function (Request $request, $id) {
    return App\Climb::where('id', $id)->with('attempts.user')->first();
});

/**
 * Create a new climb
 * 
 * Returns the new climb as JSON
 */
Route::middleware('auth:api')->post('/climbs', function (Request $request) {
    $climb =  App\Climb::create($request->all());
    $climb->createLabel();
    return $climb;
});

/**
 * Update a Climb
 * 
 * Returns the updated climb as JSON
 */
Route::middleware('auth:api')->post('/climbs/{id}', function (Request $request, $id) {
    $climb =  App\Climb::findOrFail($id);
    $climb->fill($request->all())->save();
    return $climb;
});

/**
 * Get a list of all attempts
 */
Route::middleware('auth:api')->get('/attempts', function (Request $request) {
    return App\Attempt::all();
});

/**
 * Create a new attempt
 * 
 * Returns the new attempt as JSON
 */
Route::middleware('auth:api')->post('/attempts', function (Request $request) {
    $attempt =  App\Attempt::create($request->all());
    $climb_id = $request->input('climb_id');
    $climb =  App\Climb::where('id', $climb_id)->with('attempts.user')->first();
    return $climb;
});

