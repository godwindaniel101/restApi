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
// Route::resource('employee' , 'EmployeeController');
// Route::post('register' , 'api/class AuthenticationController@register');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'api\AuthenticationController@login');
    Route::post('register', 'api\AuthenticationController@register');

    Route::post('createEmployee', 'api\EmployeeController@createEmployee');
    Route::post('updateEmployee/{id}', 'api\EmployeeController@updateEmployee');
    Route::get('getEmployee', 'api\EmployeeController@getEmployee');
    Route::get('getEmployeeRecord/{id}', 'api\EmployeeController@getEmployeeRecord');
    Route::delete('deleteEmployee/{id}', 'api\EmployeeController@deleteEmployee');
    
    Route::post('createProject', 'api\ProjectController@createProject');
    Route::post('updateProject/{id}', 'api\ProjectController@updateProject');
    Route::get('getProject', 'api\ProjectController@getProject');
    Route::get('getProjectRecord/{id}', 'api\ProjectController@getProjectRecord');
    Route::delete('deleteProject/{id}', 'api\ProjectController@deleteProject');
    
    
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'api\AuthenticationController@logout');
        Route::get('user', 'api\AuthenticationController@user');
    });
});