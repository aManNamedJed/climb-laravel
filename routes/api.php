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
    return $request->user();
});

/**
 * Get a list of all climbs
 */
Route::get('/climbs', function (Request $request) {
    return App\Climb::all();
});

/**
 * Get a climb by its ID
 */
Route::get('/climbs/{id}', function (Request $request, $id) {
    return App\Climb::where('id', $id)->with('attempts')->get();
});

/**
 * Create a new climb
 * 
 * Returns the new climb as JSON
 */
Route::post('/climbs', function (Request $request) {
    $climb =  App\Climb::create($request->all());
    $climb->createLabel();
    return $climb;
});

/**
 * Update a Climb
 * 
 * Returns the updated climb as JSON
 */
Route::post('/climbs/{id}', function (Request $request, $id) {
    $climb =  App\Climb::findOrFail($id);
    $climb->fill($request->all())->save();
    return $climb;
});

/**
 * Get a list of all attempts
 */
Route::get('/attempts', function (Request $request) {
    return App\Attempt::all();
});

/**
 * Create a new attempt
 * 
 * Returns the new attempt as JSON
 */
Route::post('/attempts', function (Request $request) {
    $attempt =  App\Attempt::create($request->all());
    return $attempt;
});

