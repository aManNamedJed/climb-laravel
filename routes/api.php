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
    return App\Climb::findOrFail($id);
});

/**
 * Create a new climb
 * 
 * Returns the new climb as JSON
 */
Route::post('/climbs', function (Request $request, $id) {
    return App\Climb::create($request->all());
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

