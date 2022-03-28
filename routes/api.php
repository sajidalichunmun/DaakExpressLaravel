<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

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

//users
Route::prefix('/user')->group(function(){
    Route::post('/login','Api\ApiLoginController@login');
});

Route::post('mobilesms','Api\ApiLoginController@mobilesms');
Route::post('forgot','Api\ApiLoginController@forgot');
Route::post('reset','Api\ApiLoginController@reset');
//public routes

Route::get('/awb', 'api\ApiAwbMasterController@GetList');
Route::get('/awb/{id}', 'api\ApiAwbMasterController@GetDataById');

Route::get('/packettype', 'api\ApiPacketTypeController@GetList');
Route::get('/packettype/{id}', 'api\ApiPacketTypeController@GetDataById');

Route::get('/country', 'api\ApiCountryController@GetList');
Route::get('/country/{id}', 'api\ApiCountryController@GetDataById');

Route::get('/state', 'api\ApiStateController@GetList');
Route::get('/state/{id}', 'api\ApiStateController@GetDataById');

Route::get('/city', 'api\ApiCityController@GetList');
Route::get('/city/{id}', 'api\ApiCityController@GetDataById');

Route::get('/relation', 'api\ApiRelationController@GetList');
Route::get('/relation/{id}', 'api\ApiRelationController@GetDataById');

Route::get('/reason', 'api\ApiReasonController@GetList');
Route::get('/reason/{id}', 'api\ApiReasonController@GetDataById');

Route::get('/packetstatus', 'api\ApiPacketStatusController@GetList');
Route::get('/packetstatus/{id}', 'api\ApiPacketStatusController@GetDataById');

Route::get('/major', 'api\ApiMajorCodeController@GetList');
Route::get('/major/{id}', 'api\ApiMajorCodeController@GetDataById');

Route::get('/client', 'api\ApiClientCodeController@GetList');
Route::get('/client/{id}', 'api\ApiClientCodeController@GetDataById');

Route::get('/subcity', 'api\ApiSubAreaController@GetList');
Route::get('/subcity/{id}', 'api\ApiSubAreaController@GetDataById');

Route::get('/franchisee', 'api\ApiFranchiseeController@GetList');
Route::get('/franchisee/{id}', 'api\ApiFranchiseeController@GetDataById');

//protected routes
// Route::group(['middleware' => ['auth:sanctum']], function () 
Route::group(['middleware' => ['auth:api']], function () 
{
    Route::get('/user',[App\Http\Controllers\Api\ApiLoginController::class,'user']);
    Route::post('/apilogout',[App\Http\Controllers\Api\ApiLoginController::class,'apilogout']);

    Route::post('/packettype', [api\ApiPacketTypeController::class,'store']);
    Route::put('/packettype/{id}', [api\ApiPacketTypeController::class,'update']);
    Route::delete('/packettype/{id}', [api\ApiPacketTypeController::class,'delete']);

    Route::post('/major', [api\ApiMajorCodeController::class,'store']);
    Route::put('/major/{id}', [api\ApiMajorCodeController::class,'update']);
    Route::delete('/major/{id}', [api\ApiMajorCodeController::class,'delete']);

    Route::post('/client', [api\ApiClientCodeController::class,'store']);
    Route::put('/client/{id}', [api\ApiClientCodeController::class,'update']);
    Route::delete('/client/{id}', [api\ApiClientCodeController::class,'delete']);

    Route::post('/country', [api\ApiCountryController::class,'store']);
    Route::put('/country/{id}', [api\ApiCountryController::class,'update']);
    Route::delete('/country/{id}', [api\ApiCountryController::class,'delete']);
    
    Route::post('/state', [api\ApiStateController::class,'store']);
    Route::put('/state/{id}', [api\ApiStateController::class,'update']);
    Route::delete('/state/{id}', [api\ApiStateController::class,'delete']);
    
    Route::post('/city', [api\ApiCityController::class,'store']);
    Route::put('/city/{id}', [api\ApiCityController::class,'update']);
    Route::delete('/city/{id}', [api\ApiCityController::class,'delete']);
    
    Route::post('/subcity', [api\ApiSubAreaController::class,'store']);
    Route::put('/subcity/{id}', [api\ApiSubAreaController::class,'update']);
    Route::delete('/subcity/{id}', [api\ApiSubAreaController::class,'delete']);

    Route::post('/relation', [api\ApiRelationController::class,'store']);
    Route::put('/relation/{id}', [api\ApiRelationController::class,'update']);
    Route::delete('/relation/{id}', [api\ApiRelationController::class,'delete']);
    
    Route::post('/reason', [api\ApiReasonController::class,'store']);
    Route::put('/reason/{id}', [api\ApiReasonController::class,'update']);
    Route::delete('/reason/{id}', [api\ApiReasonController::class,'delete']);
    
    Route::post('/packetstatus', 'api\ApiPacketStatusController@store');
    Route::put('/packetstatus/{id}', 'api\ApiPacketStatusController@update');
    Route::delete('/packetstatus/{id}', 'api\ApiPacketStatusController@delete');

    Route::post('/franchisee', [api\ApiFranchiseeController::class,'store']);
    Route::put('/franchisee/{id}', [api\ApiFranchiseeController::class,'update']);
    Route::delete('/franchisee/{id}', [api\ApiFranchiseeController::class,'delete']);
});

