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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// Route::get('/orders', function (Request $request) {
//     if ($request->user()->tokenCan('delete-orders')) {
//         return 'success';
//     } else {
//     	return 'token accepted, but no access';
//     }
// })->middleware('auth:api');

Route::get('/test', function(Request $request){
	return response()->json([
		'user' => [
			 'first_name' => 'Swapnil',
			'last_name' => 'Chaudhari'
		]
		
	]);
});