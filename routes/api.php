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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v1', 'middleware' => ['cors','api'], 'namespace' => 'App\Http\Controllers\Api'], function ($api) {

    	$api->group(['prefix'=>'auth'], function($api){
    	    $api->post('login', 'AuthController@login');
    	    $api->get('refresh', 'AuthController@refresh');
    	    $api->get('logout', 'AuthController@logout');
    	}); //end api->group['prefix->auth']

    	$api->group(['middleware' => ['jwt.auth']], function ($api) {
    		$api->get('users','UserController@index');
    	}); //end api->group['middleware->jwt.auth']

    }); //end api->group['prefix'=> 'v1', 'middleware'=>['cors','api']

}); //end api->version
