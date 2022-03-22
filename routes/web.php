<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintPodController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

//public routes



Route::get('/About', 'AboutController@index')->name('About');
Route::get('/Contact', 'ContactController@index')->name('Contact');
Route::post('/save-contact', 'ContactController@store')->name('save-contact');
Route::get('/Service', 'ServiceController@index')->name('Service');


$router->post('product','ApiDeliveryController@createProduct');   //for creating product
$router->get('product/{id}','ApiDeliveryController@updateProduct'); //for updating product
$router->post('product/{id}','ApiDeliveryController@deleteProduct');  // for deleting product
$router->get('product','ApiDeliveryController@index'); // for retrieving product

Route::get('ajax-form-submit', 'FormController@index');
Route::post('save-form', 'FormController@store');

 
// Route::get('/', function () {
//     return view('index');
// });

Route::get('/','InitialController@index');

Route::get('forgotusername','Auth\LoginController@ForgotUsername')->name('forgotusername');
Route::post('forgot-username','Auth\LoginController@ForgotUsername1')->name('forgot-username');

Route::post('queryPod','AjaxSearchController@queryPod')->name('queryPod');
Route::post('queryPod1','AjaxSearchController@queryPod1')->name('queryPod1');
Route::post('queryPod2','AjaxSearchController@search_pod_status_details')->name('queryPod2');
Route::post('searchAjax/trackingpod',array('as' => 'searchAjax/trackingpod','uses' => 'AjaxSearchController@trackingpod'))->name('searchAjax/trackingpod');
Route::get('trackingpod','CityController@trackingpod')->name('trackingpod');
Route::get('query','QueryController@index')->name('query');
//Route::auth();
Auth::routes();


//Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('menus','MenusController');
Route::resource('users','UsersController');


Route::group([
    'prefix' => 'menus','middleware' => ['auth']
], function () {
    Route::get('/', 'MenusController@index')
         ->name('menus.menu.index');
    Route::get('/create','MenusController@create')
         ->name('menus.menu.create');
    Route::get('/show/{menu}','MenusController@show')
         ->name('menus.menu.show')->where('id', '[0-9]+');
    Route::get('/{menu}/edit','MenusController@edit')
         ->name('menus.menu.edit')->where('id', '[0-9]+');
    Route::post('/', 'MenusController@store')
         ->name('menus.menu.store');
    Route::put('menu/{menu}', 'MenusController@update')
         ->name('menus.menu.update')->where('id', '[0-9]+');
    Route::delete('/menu/{menu}','MenusController@destroy')
         ->name('menus.menu.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'users','middleware' => ['auth']
], function () {
    Route::get('/', 'UsersController@index')
         ->name('users.user.index');
    Route::get('/create','UsersController@create')
         ->name('users.user.create');
    Route::get('/show/{user}','UsersController@show')
         ->name('users.user.show')->where('id', '[0-9]+');
    Route::get('/{user}/edit','UsersController@edit')
         ->name('users.user.edit')->where('id', '[0-9]+');
    Route::post('/', 'UsersController@store')
         ->name('users.user.store');
    Route::put('user/{user}', 'UsersController@update')
         ->name('users.user.update')->where('id', '[0-9]+');
    Route::delete('/user/{user}','UsersController@destroy')
         ->name('users.user.destroy')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'user_menus','middleware' => ['auth']
], function () {

    Route::get('/', 'UserMenusController@index')
         ->name('user_menus.user_menu.index');

    Route::get('/create','UserMenusController@create')
         ->name('user_menus.user_menu.create');

    Route::get('/show/{userMenu}','UserMenusController@show')
         ->name('user_menus.user_menu.show')
         ->where('id', '[0-9]+');

    Route::get('/{userMenu}/edit','UserMenusController@edit')
         ->name('user_menus.user_menu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UserMenusController@store')
         ->name('user_menus.user_menu.store');
               
    Route::put('user_menu/{userMenu}', 'UserMenusController@update')
         ->name('user_menus.user_menu.update')
         ->where('id', '[0-9]+');

    Route::delete('/user_menu/{userMenu}','UserMenusController@destroy')
         ->name('user_menus.user_menu.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'roles','middleware' => ['auth']
], function () {

    Route::get('/', 'RolesController@index')
         ->name('roles.role.index');

    Route::get('/create','RolesController@create')
         ->name('roles.role.create');

    Route::get('/show/{role}','RolesController@show')
         ->name('roles.role.show')
         ->where('id', '[0-9]+');

    Route::get('/{role}/edit','RolesController@edit')
         ->name('roles.role.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RolesController@store')
         ->name('roles.role.store');
               
    Route::put('role/{role}', 'RolesController@update')
         ->name('roles.role.update')
         ->where('id', '[0-9]+');

    Route::delete('/role/{role}','RolesController@destroy')
         ->name('roles.role.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'packet-type-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'PacketTypeController@index')
         ->name('PacketType.Mast.index');

    Route::get('/create','PacketTypeController@create')
         ->name('PacketType.Mast.create');

    Route::get('/show/{Mast}','PacketTypeController@show')
         ->name('PacketType.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','PacketTypeController@edit')
         ->name('PacketType.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PacketTypeController@store')
         ->name('PacketType.Mast.store');
               
    Route::put('Mast/{Mast}', 'PacketTypeController@update')
         ->name('PacketType.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','PacketTypeController@destroy')
         ->name('PacketType.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/packetType_search', 'PacketTypeController@Search')->name('packetType_search');
         
});

Route::group(
[
    'prefix' => 'major-code-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'MajorCodeController@index')
         ->name('MajorCode.Mast.index');
	
		 
    Route::get('/create','MajorCodeController@create')
         ->name('MajorCode.Mast.create');

    Route::get('/show/{Mast}','MajorCodeController@show')
         ->name('MajorCode.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','MajorCodeController@edit')
         ->name('MajorCode.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'MajorCodeController@store')
         ->name('MajorCode.Mast.store');
               
    Route::put('Mast/{Mast}', 'MajorCodeController@update')
         ->name('MajorCode.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','MajorCodeController@destroy')
         ->name('MajorCode.Mast.destroy')
         ->where('id', '[0-9]+');
	
	Route::get('/major_search', 'MajorCodeController@Search')->name('major_search');
});

Route::group(
[
    'prefix' => 'client-code-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'ClientCodeController@index')
         ->name('ClientCode.Mast.index');
		 
    Route::get('/create','ClientCodeController@create')
         ->name('ClientCode.Mast.create');

    Route::get('/show/{Mast}','ClientCodeController@show')
         ->name('ClientCode.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','ClientCodeController@edit')
         ->name('ClientCode.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ClientCodeController@store')
         ->name('ClientCode.Mast.store');
               
    Route::put('Mast/{Mast}', 'ClientCodeController@update')
         ->name('ClientCode.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','ClientCodeController@destroy')
         ->name('ClientCode.Mast.destroy')
         ->where('id', '[0-9]+');
	
	Route::get('/clientcode_search', 'ClientCodeController@Search')->name('clientcode_search');	

});

Route::group(
[
    'prefix' => 'client-rate-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'ClientRateController@index')
         ->name('ClientRate.Mast.index');

    Route::get('/create','ClientRateController@create')
         ->name('ClientRate.Mast.create');

    Route::get('/show/{Mast}','ClientRateController@show')
         ->name('ClientRate.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','ClientRateController@edit')
         ->name('ClientRate.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ClientRateController@store')
         ->name('ClientRate.Mast.store');
               
    Route::put('Mast/{Mast}', 'ClientRateController@update')
         ->name('ClientRate.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','ClientRateController@destroy')
         ->name('ClientRate.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/clientrate_search', 'ClientRateController@Search')->name('clientrate_search');
	
});


Route::group(
[
    'prefix' => 'country-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'CountryController@index')
         ->name('Country.Mast.index');
		 
    Route::get('/create','CountryController@create')
         ->name('Country.Mast.create');

    Route::get('/show/{Mast}','CountryController@show')
         ->name('Country.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','CountryController@edit')
         ->name('Country.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CountryController@store')
         ->name('Country.Mast.store');
               
    Route::put('Mast/{Mast}', 'CountryController@update')
         ->name('Country.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','CountryController@destroy')
         ->name('Country.Mast.destroy')
         ->where('id', '[0-9]+');
	
	Route::get('/country_search', 'CountryController@Search')->name('country_search');
});

Route::get('api/get-state-list','CityController@getStateList');
Route::get('api/get-city-list','CityController@getCityList');
Route::get('api/get-major-name','ClientCodeController@getMajorNameList');

Route::group(
[
    'prefix' => 'state-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'StateController@index')
         ->name('State.Mast.index');
	
    Route::get('/create','StateController@create')
         ->name('State.Mast.create');

    Route::get('/show/{Mast}','StateController@show')
         ->name('State.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','StateController@edit')
         ->name('State.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'StateController@store')
         ->name('State.Mast.store');
               
    Route::put('Mast/{Mast}', 'StateController@update')
         ->name('State.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','StateController@destroy')
         ->name('State.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/state_search', 'StateController@Search')->name('state_search');
	
});


Route::group(
[
    'prefix' => 'city-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'CityController@index')
         ->name('City.Mast.index');
	
	Route::get('/Search', 'CityController@search');
	
    Route::get('/create','CityController@create')
         ->name('City.Mast.create');

    Route::get('/show/{Mast}','CityController@show')
         ->name('City.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','CityController@edit')
         ->name('City.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CityController@store')
         ->name('City.Mast.store');
               
    Route::put('Mast/{Mast}', 'CityController@update')
         ->name('City.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','CityController@destroy')
         ->name('City.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/city_search', 'CityController@Search')->name('city_search');
});

//Route::get('searchFloorAjax/searchCountry',array('as' => 'searchFloorAjax/searchCountry','uses' => 'AjaxSearchController@searchCountry'));

Route::group(
[
    'prefix' => 'subcity-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'SubAreaController@index')
         ->name('SubArea.Mast.index');
	
	Route::get('/Search', 'SubAreaController@search');
	
    Route::get('/create','SubAreaController@create')
         ->name('SubArea.Mast.create');

    Route::get('/show/{Mast}','SubAreaController@show')
         ->name('SubArea.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','SubAreaController@edit')
         ->name('SubArea.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'SubAreaController@store')
         ->name('SubArea.Mast.store');
               
    Route::put('Mast/{Mast}', 'SubAreaController@update')
         ->name('SubArea.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','SubAreaController@destroy')
         ->name('SubArea.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/subare_search', 'SubAreaController@Search')->name('subare_search');
});
Route::get('searchFlatAjax/searchCity',array('as' => 'searchFlatAjax/searchCity','uses' => 'AjaxSearchController@searchCity'));
Route::post('searchAjax/searchClientCode1',array('as' => 'searchAjax/searchClientCode1','uses' => 'AjaxSearchController@searchClientCode1'));
Route::post('searchAjax/searchAreaName',array('as' => 'searchAjax/searchAreaName','uses' => 'AjaxSearchController@searchAreaName'));

Route::any('searchAjax/searchClientDataRefNo',array('as' => 'searchAjax/searchClientDataRefNo','uses' => 'AjaxSearchController@searchClientDataRefNo'));
Route::any('searchAjax/searchClientDataBarcodeNo',array('as' => 'searchAjax/searchClientDataBarcodeNo','uses' => 'AjaxSearchController@searchClientDataBarcodeNo'));

Route::any('searchAjax/searchPodUpdation',array('as' => 'searchAjax/searchPodUpdation','uses' => 'AjaxSearchController@searchPodUpdation'));
Route::get('searchAjax/searchUserSeriesAllocation',array('as' => 'searchAjax/searchUserSeriesAllocation','uses' => 'AjaxSearchController@searchUserSeriesAllocation'));

Route::post('searchClientCode','AjaxSearchController@searchClientCode');
Route::get('getInfo/{id}', 'AjaxSearchController@getInfo');

Route::group(
[
    'prefix' => 'reason-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'ReasonController@index')
         ->name('Reason.Mast.index');
	
	Route::get('/Search', 'ReasonController@search');
	
    Route::get('/create','ReasonController@create')
         ->name('Reason.Mast.create');

    Route::get('/show/{Mast}','ReasonController@show')
         ->name('Reason.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','ReasonController@edit')
         ->name('Reason.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ReasonController@store')
         ->name('Reason.Mast.store');
               
    Route::put('Mast/{Mast}', 'ReasonController@update')
         ->name('Reason.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','ReasonController@destroy')
         ->name('Reason.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('reason_search', 'ReasonController@Search')->name('reason_search');
	
});


Route::group(
[
    'prefix' => 'relation-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'RelationController@index')
         ->name('Relation.Mast.index');

    Route::get('/create','RelationController@create')
         ->name('Relation.Mast.create');

    Route::get('/show/{Mast}','RelationController@show')
         ->name('Relation.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','RelationController@edit')
         ->name('Relation.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RelationController@store')
         ->name('Relation.Mast.store');
               
    Route::put('Mast/{Mast}', 'RelationController@update')
         ->name('Relation.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','RelationController@destroy')
         ->name('Relation.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/relation_search', 'RelationController@Search')->name('relation_search');
	
});

Route::group(
[
    'prefix' => 'franchisee-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'FranchiseeController@index')
         ->name('Franchisee.Mast.index');

    Route::get('/create','FranchiseeController@create')
         ->name('Franchisee.Mast.create');

    Route::get('/show/{Mast}','FranchiseeController@show')
         ->name('Franchisee.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','FranchiseeController@edit')
         ->name('Franchisee.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'FranchiseeController@store')
         ->name('Franchisee.Mast.store');
               
    Route::put('Mast/{Mast}', 'FranchiseeController@update')
         ->name('Franchisee.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','FranchiseeController@destroy')
         ->name('Franchisee.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/fran-search', 'FranchiseeController@Search')->name('fran-search');
	
});


Route::group(
[
    'prefix' => 'franchisee-rate-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'FranchiseeRateController@index')
         ->name('FranchiseeRate.Mast.index');

    Route::get('/create','FranchiseeRateController@create')
         ->name('FranchiseeRate.Mast.create');

    Route::get('/show/{Mast}','FranchiseeRateController@show')
         ->name('FranchiseeRate.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','FranchiseeRateController@edit')
         ->name('FranchiseeRate.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'FranchiseeRateController@store')
         ->name('FranchiseeRate.Mast.store');
               
    Route::put('Mast/{Mast}', 'FranchiseeRateController@update')
         ->name('FranchiseeRate.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','FranchiseeRateController@destroy')
         ->name('FranchiseeRate.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/fran-rate-search', 'FranchiseeRateController@Search')->name('fran-rate-search');
	
});

Route::group(
[
    'prefix' => 'delivery-boy-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'DeliveryBoyController@index')
         ->name('DeliveryBoy.Mast.index');

    Route::get('/create','DeliveryBoyController@create')
         ->name('DeliveryBoy.Mast.create');

    Route::get('/show/{Mast}','DeliveryBoyController@show')
         ->name('DeliveryBoy.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','DeliveryBoyController@edit')
         ->name('DeliveryBoy.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DeliveryBoyController@store')
         ->name('DeliveryBoy.Mast.store');
               
    Route::put('Mast/{Mast}', 'DeliveryBoyController@update')
         ->name('DeliveryBoy.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','DeliveryBoyController@destroy')
         ->name('DeliveryBoy.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/delivery-boy-search', 'DeliveryBoyController@Search')->name('delivery-boy-search');
	
});


Route::group(
[
    'prefix' => 'series-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'SeriesController@index')
         ->name('Series.Mast.index');

    Route::get('/create','SeriesController@create')
         ->name('Series.Mast.create');

    Route::get('/show/{Mast}','SeriesController@show')
         ->name('Series.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','SeriesController@edit')
         ->name('Series.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'SeriesController@store')
         ->name('Series.Mast.store');
               
    Route::put('Mast/{Mast}', 'SeriesController@update')
         ->name('Series.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','SeriesController@destroy')
         ->name('Series.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/series-mast-search', 'SeriesController@Search')->name('series-mast-search');
	
});


Route::group(
[
    'prefix' => 'assigned-series-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'AssignedSeriesController@index')
         ->name('AssignedSeries.Mast.index');

    Route::get('/create','AssignedSeriesController@create')
         ->name('AssignedSeries.Mast.create');

    Route::get('/show/{Mast}','AssignedSeriesController@show')
         ->name('AssignedSeries.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','AssignedSeriesController@edit')
         ->name('AssignedSeries.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'AssignedSeriesController@store')
         ->name('AssignedSeries.Mast.store');
               
    Route::put('Mast/{Mast}', 'AssignedSeriesController@update')
         ->name('AssignedSeries.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','AssignedSeriesController@destroy')
         ->name('AssignedSeries.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/assigned-series-search', 'AssignedSeriesController@Search')->name('assigned-series-search');
	
});


Route::group(
[
    'prefix' => 'packet-status-mast','middleware' => ['auth']
], function () {

    Route::get('/', 'PacketStatusController@index')
         ->name('PacketStatus.Mast.index');

    Route::get('/create','PacketStatusController@create')
         ->name('PacketStatus.Mast.create');

    Route::get('/show/{Mast}','PacketStatusController@show')
         ->name('PacketStatus.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','PacketStatusController@edit')
         ->name('PacketStatus.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PacketStatusController@store')
         ->name('PacketStatus.Mast.store');
               
    Route::put('Mast/{Mast}', 'PacketStatusController@update')
         ->name('PacketStatus.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','PacketStatusController@destroy')
         ->name('PacketStatus.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/packet-status-search', 'PacketStatusController@Search')->name('packet-status-search');
	
});



Route::group(
[
    'prefix' => 'tran-pickup','middleware' => ['auth']
], function () {

    Route::get('/', 'PickeupController@index')
         ->name('Pickeup.Mast.index');

    Route::get('/create','PickeupController@create')
         ->name('Pickeup.Mast.create');

    Route::get('/show/{Mast}','PickeupController@show')
         ->name('Pickeup.Mast.show')
         ->where('id', '[0-9]+');

    Route::get('/{Mast}/edit','PickeupController@edit')
         ->name('Pickeup.Mast.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PickeupController@store')
         ->name('Pickeup.Mast.store');
               
    Route::put('Mast/{Mast}', 'PickeupController@update')
         ->name('Pickeup.Mast.update')
         ->where('id', '[0-9]+');

    Route::delete('/Mast/{Mast}','PickeupController@destroy')
         ->name('Pickeup.Mast.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-pickup-search', 'PickeupController@Search')->name('tran-pickup-search');
	
});

Route::group(
[
    'prefix' => 'tran-upload-client-data','middleware' => ['auth']
], function () {

    Route::get('/', 'UploadExcelDataController@index')
         ->name('UploadClientData.TranMenu.index');

    Route::get('/create','UploadExcelDataController@create')
         ->name('UploadClientData.TranMenu.create');

    Route::get('/show/{TranMenu}','UploadExcelDataController@show')
         ->name('UploadClientData.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','UploadExcelDataController@edit')
         ->name('UploadClientData.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UploadExcelDataController@store')
         ->name('UploadClientData.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'UploadExcelDataController@update')
         ->name('UploadClientData.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','UploadExcelDataController@destroy')
         ->name('UploadClientData.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/upload-client-data-search', 'UploadExcelDataController@Search')->name('upload-client-data-search');
	Route::delete('/deleteAll', 'UploadExcelDataController@deleteAll');
});

//    Route::get('/{transitWaybill}/{tab}/print','TransitWaybillsController@print')
//         ->name('transit_waybills.transit_waybill.print')
//         ->where('id', '[0-9]+');
		 
Route::group(
[
    'prefix' => 'tran-upload-pre-assigned-pod','middleware' => ['auth']
], function () {

    Route::get('/', 'UploadPreAssinedPodExcelDataController@index')
         ->name('UploadPreAssignedPod.TranMenu.index');

    Route::get('/create','UploadPreAssinedPodExcelDataController@create')
         ->name('UploadPreAssignedPod.TranMenu.create');

    Route::get('/show/{TranMenu}','UploadPreAssinedPodExcelDataController@show')
         ->name('UploadPreAssignedPod.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','UploadPreAssinedPodExcelDataController@edit')
         ->name('UploadPreAssignedPod.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UploadPreAssinedPodExcelDataController@store')
         ->name('UploadPreAssignedPod.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'UploadPreAssinedPodExcelDataController@update')
         ->name('UploadPreAssignedPod.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','UploadPreAssinedPodExcelDataController@destroy')
         ->name('UploadPreAssignedPod.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/pre-assigned-pod-search', 'UploadPreAssinedPodExcelDataController@Search')->name('pre-assigned-pod-search');
	Route::delete('/deleteAll', 'UploadPreAssinedPodExcelDataController@deleteAll');
});

Route::group(
[
    'prefix' => 'tran-mannual-pod-assigned','middleware' => ['auth']
], function () {

    Route::get('/', 'MannualPodController@index')
         ->name('MannualPod.TranMenu.index');

    Route::get('/create','MannualPodController@create')
         ->name('MannualPod.TranMenu.create');

    Route::get('/show/{TranMenu}','MannualPodController@show')
         ->name('MannualPod.TranMenu.show')
         ->where('id', '[A-Z,0-9]+');

    Route::get('/{TranMenu}/edit','MannualPodController@edit')
         ->name('MannualPod.TranMenu.edit')
         ->where('id', '[A-Z,0-9]+');

    Route::post('/', 'MannualPodController@store')
         ->name('MannualPod.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'MannualPodController@update')
         ->name('MannualPod.TranMenu.update')
         ->where('id', '[A-Z,0-9]+');

    Route::delete('/TranMenu/{TranMenu}','MannualPodController@destroy')
         ->name('MannualPod.TranMenu.destroy')
         ->where('id', '[A-Z,0-9]+');

	Route::get('/mannual-pod-search', 'MannualPodController@Search')->name('mannual-pod-search');
	
});

Route::group(
[
    'prefix' => 'tran-clientdata-pod-assigned','middleware' => ['auth']
], function () {

    Route::get('/', 'PodWithClientDataController@index')
         ->name('PodWithClientData.TranMenu.index');

    Route::get('/create','PodWithClientDataController@create')
         ->name('PodWithClientData.TranMenu.create');

    Route::get('/show/{TranMenu}','PodWithClientDataController@show')
         ->name('PodWithClientData.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','PodWithClientDataController@edit')
         ->name('PodWithClientData.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PodWithClientDataController@store')
         ->name('PodWithClientData.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'PodWithClientDataController@update')
         ->name('PodWithClientData.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','PodWithClientDataController@destroy')
         ->name('PodWithClientData.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/clientdata-pod-search', 'PodWithClientDataController@Search')->name('clientdata-pod-search');
	
});
Route::group(
     [
         'prefix' => 'delivery-rto-by-excel','middleware' => ['auth']
     ], function () {
     
         Route::get('/', 'DeliveryRtoByExcelController@index')
              ->name('deliveryrtoexcel.TranMenu.index');
     
         Route::get('/create','DeliveryRtoByExcelController@create')
              ->name('deliveryrtoexcel.TranMenu.create');
     
         Route::get('/show/{TranMenu}','DeliveryRtoByExcelController@show')
              ->name('deliveryrtoexcel.TranMenu.show')
              ->where('id', '[0-9]+');
     
         Route::get('/{TranMenu}/edit','DeliveryRtoByExcelController@edit')
              ->name('deliveryrtoexcel.TranMenu.edit')
              ->where('id', '[0-9]+');
     
         Route::post('/', 'DeliveryRtoByExcelController@store')
              ->name('deliveryrtoexcel.TranMenu.store');
                    
         Route::put('TranMenu/{TranMenu}', 'DeliveryRtoByExcelController@update')
              ->name('deliveryrtoexcel.TranMenu.update')
              ->where('id', '[0-9]+');
     
         Route::delete('/TranMenu/{TranMenu}','DeliveryRtoByExcelController@destroy')
              ->name('deliveryrtoexcel.TranMenu.destroy')
              ->where('id', '[0-9]+');
     
          Route::get('/deliveryrtoexcel-search', 'DeliveryRtoByExcelController@Search')->name('deliveryrtoexcel-search');
          Route::delete('/delivery_rto_deleteAll', 'DeliveryRtoByExcelController@deleteAll')->name('delivery_rto_deleteAll');
     });

Route::group(
     [
          'prefix' => 'upload-state-excel-data','middleware' => ['auth']
     ], function () {
     
          Route::get('/', 'UploadStateController@index')
               ->name('uploadstate.TranMenu.index');
     
          Route::get('/create','UploadStateController@create')
               ->name('uploadstate.TranMenu.create');
     
          Route::get('/show/{TranMenu}','UploadStateController@show')
               ->name('uploadstate.TranMenu.show')
               ->where('id', '[0-9]+');
     
          Route::get('/{TranMenu}/edit','UploadStateController@edit')
               ->name('uploadstate.TranMenu.edit')
               ->where('id', '[0-9]+');
     
          Route::post('/', 'UploadStateController@store')
               ->name('uploadstate.TranMenu.store');
                    
          Route::put('TranMenu/{TranMenu}', 'UploadStateController@update')
               ->name('uploadstate.TranMenu.update')
               ->where('id', '[0-9]+');
     
          Route::delete('/TranMenu/{TranMenu}','UploadStateController@destroy')
               ->name('uploadstate.TranMenu.destroy')
               ->where('id', '[0-9]+');
     
          Route::get('/uploadstate_search', 'UploadStateController@Search')->name('uploadstate_search');
          Route::delete('/uploadstate_deleteAll', 'UploadStateController@deleteAll')->name('uploadstate_deleteAll');
     });
Route::group(
     [
          'prefix' => 'upload-city-excel-data','middleware' => ['auth']
     ], function () {
     
          Route::get('/', 'UploadCityController@index')
               ->name('uploadcity.TranMenu.index');
     
          Route::get('/create','UploadCityController@create')
               ->name('uploadcity.TranMenu.create');
     
          Route::get('/show/{TranMenu}','UploadCityController@show')
               ->name('uploadcity.TranMenu.show')
               ->where('id', '[0-9]+');
     
          Route::get('/{TranMenu}/edit','UploadCityController@edit')
               ->name('uploadcity.TranMenu.edit')
               ->where('id', '[0-9]+');
     
          Route::post('/', 'UploadCityController@store')
               ->name('uploadcity.TranMenu.store');
                    
          Route::put('TranMenu/{TranMenu}', 'UploadCityController@update')
               ->name('uploadcity.TranMenu.update')
               ->where('id', '[0-9]+');
     
          Route::delete('/TranMenu/{TranMenu}','UploadCityController@destroy')
               ->name('uploadcity.TranMenu.destroy')
               ->where('id', '[0-9]+');
     
          Route::get('/uploadcity_search', 'UploadCityController@Search')->name('uploadcity_search');
          Route::delete('/uploadcity_deleteAll', 'UploadCityController@deleteAll')->name('uploadcity_deleteAll');
     });
Route::group(
     [
          'prefix' => 'upload-subarea-excel-data','middleware' => ['auth']
     ], function () {
     
          Route::get('/', 'UploadSubareaController@index')
               ->name('uploadsubarea.TranMenu.index');
     
          Route::get('/create','UploadSubareaController@create')
               ->name('uploadsubarea.TranMenu.create');
     
          Route::get('/show/{TranMenu}','UploadSubareaController@show')
               ->name('uploadsubarea.TranMenu.show')
               ->where('id', '[0-9]+');
     
          Route::get('/{TranMenu}/edit','UploadSubareaController@edit')
               ->name('uploadsubarea.TranMenu.edit')
               ->where('id', '[0-9]+');
     
          Route::post('/', 'UploadSubareaController@store')
               ->name('uploadsubarea.TranMenu.store');
                    
          Route::put('TranMenu/{TranMenu}', 'UploadSubareaController@update')
               ->name('uploadsubarea.TranMenu.update')
               ->where('id', '[0-9]+');
     
          Route::delete('/TranMenu/{TranMenu}','UploadSubareaController@destroy')
               ->name('uploadsubarea.TranMenu.destroy')
               ->where('id', '[0-9]+');
     
          Route::get('/uploadsubarea_search', 'UploadSubareaController@Search')->name('uploadsubarea_search');
          Route::delete('/uploadsubarea_deleteAll', 'UploadSubareaController@deleteAll')->name('uploadsubarea_deleteAll');
     });
     
Route::group(
[
    'prefix' => 'tran-update-pods','middleware' => ['auth']
], function () {

    Route::get('/', 'UpdatePodController@index')
         ->name('UpdatePod.TranMenu.index');

    Route::get('/create','UpdatePodController@create')
         ->name('UpdatePod.TranMenu.create');

    Route::get('/show/{TranMenu}','UpdatePodController@show')
         ->name('UpdatePod.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','UpdatePodController@edit')
         ->name('UpdatePod.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UpdatePodController@store')
         ->name('UpdatePod.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'UpdatePodController@update')
         ->name('UpdatePod.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','UpdatePodController@destroy')
         ->name('UpdatePod.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-update-pods-search', 'UpdatePodController@Search')->name('tran-update-pods-search');
	
});

Route::group(
[
    'prefix' => 'tran-rto-status','middleware' => ['auth']
], function () {

    Route::get('/', 'RTOController@index')
         ->name('rto.TranMenu.index');

    Route::get('/create','RTOController@create')
         ->name('rto.TranMenu.create');

    Route::get('/show/{TranMenu}','RTOController@show')
         ->name('rto.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','RTOController@edit')
         ->name('rto.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RTOController@store')
         ->name('rto.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'RTOController@update')
         ->name('rto.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','RTOController@destroy')
         ->name('rto.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-rto-status-search', 'RTOController@Search')->name('tran-rto-status-search');
	
});


Route::group(
[
    'prefix' => 'tran-manifest-podwise','middleware' => ['auth']
], function () {

    Route::get('/', 'ManifestMannualController@index')
         ->name('ManifestMannual.TranMenu.index');

    Route::get('/create','ManifestMannualController@create')
         ->name('ManifestMannual.TranMenu.create');

    Route::get('/show/{TranMenu}','ManifestMannualController@show')
         ->name('ManifestMannual.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','ManifestMannualController@edit')
         ->name('ManifestMannual.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ManifestMannualController@store')
         ->name('ManifestMannual.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'ManifestMannualController@update')
         ->name('ManifestMannual.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','ManifestMannualController@destroy')
         ->name('ManifestMannual.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-manifest-podwise-search', 'ManifestMannualController@Search')->name('tran-manifest-podwise-search');
	
});

Route::group(
[
    'prefix' => 'tran-manifest-bulk','middleware' => ['auth']
], function () {

    Route::get('/', 'ManifestBulkController@index')
         ->name('ManifestBulk.TranMenu.index');

    Route::get('/create','ManifestBulkController@create')
         ->name('ManifestBulk.TranMenu.create');

    Route::get('/show/{TranMenu}','ManifestBulkController@show')
         ->name('ManifestBulk.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','ManifestBulkController@edit')
         ->name('ManifestBulk.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ManifestBulkController@store')
         ->name('ManifestBulk.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'ManifestBulkController@update')
         ->name('ManifestBulk.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','ManifestBulkController@destroy')
         ->name('ManifestBulk.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-manifest-bulk-podwise-search', 'ManifestBulkController@Search')->name('tran-manifest-bulk-podwise-search');
	
});

Route::group(
[
    'prefix' => 'tran-in-scaning','middleware' => ['auth']
], function () {

    Route::get('/', 'ScanInPodController@index')
         ->name('ScanInPod.TranMenu.index');

    Route::get('/create','ScanInPodController@create')
         ->name('ScanInPod.TranMenu.create');

    Route::get('/show/{TranMenu}','ScanInPodController@show')
         ->name('ScanInPod.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','ScanInPodController@edit')
         ->name('ScanInPod.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ScanInPodController@store')
         ->name('ScanInPod.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'ScanInPodController@update')
         ->name('ScanInPod.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','ScanInPodController@destroy')
         ->name('ScanInPod.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-in-scaning-podwise-search', 'ScanInPodController@Search')->name('tran-in-scaning-podwise-search');
	
});

Route::group(
[
    'prefix' => 'tran-out-scaning','middleware' => ['auth']
], function () {

    Route::get('/', 'ScanOutPodController@index')
         ->name('ScanOutPod.TranMenu.index');

    Route::get('/create','ScanOutPodController@create')
         ->name('ScanOutPod.TranMenu.create');

    Route::get('/show/{TranMenu}','ScanOutPodController@show')
         ->name('ScanOutPod.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','ScanOutPodController@edit')
         ->name('ScanOutPod.TranMenu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ScanOutPodController@store')
         ->name('ScanOutPod.TranMenu.store');
               
    Route::put('TranMenu/{TranMenu}', 'ScanOutPodController@update')
         ->name('ScanOutPod.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','ScanOutPodController@destroy')
         ->name('ScanOutPod.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/tran-out-scaning-podwise-search', 'ScanOutPodController@Search')->name('tran-out-scaning-podwise-search');
	
});
// Route::get('/pdf', function()
// {
//     $pdf = App::make('dompdf.wrapper');
//     $pdf->loadHTML('<h1>Test</h1>');
//     return $pdf->download('invoice.pdf');
// });

Route::view('barcode', 'print.barcode');
Route::post('downloadPdf','PrintPodController@downloadPdf')->name('downloadPdf');
//Route::post('/generate-barcode',[ss::class, 'showBarcode'])->name('barcode.show');
//Route::get('/generate-barcode', [ProductController::class, 'index'])->name('generate.barcode');
Route::group(
[
    'prefix' => 'tran-print-awb','middleware' => ['auth']
], function () {

	Route::get('/', 'PrintPodController@index')
         ->name('Print.TranMenu.index');
     Route::get('/printpod', 'PrintPodController@create')
         ->name('Print.TranMenu.create');
     // Route::post('/', 'PrintPodController@showBarcode')
     //     ->name('Print.TranMenu.show');
     Route::post('/show', 'PrintPodController@showBarcode')
     ->name('Print.TranMenu.show');
     //Route::post('/generate-barcode',[PrintPodController::class, 'showBarcode'])->name('Print.transmenu.show');
     //Route::post('/generate-barcode',[BarcodeController::class, 'showBarcode'])->name('barcode.show');
		 /*
    Route::get('/', 'PrintPodController@index')
         ->name('ScanOutPod.TranMenu.index');

    Route::get('/create','PrintPodController@create')
         ->name('ScanOutPod.TranMenu.create');

    Route::get('/show/{TranMenu}','PrintPodController@show')
         ->name('ScanOutPod.TranMenu.show')
         ->where('id', '[0-9]+');

    Route::get('/{TranMenu}/edit','PrintPodController@edit')
         ->name('ScanOutPod.TranMenu.edit')
         ->where('id', '[0-9]+');

    
               
    Route::put('TranMenu/{TranMenu}', 'PrintPodController@update')
         ->name('ScanOutPod.TranMenu.update')
         ->where('id', '[0-9]+');

    Route::delete('/TranMenu/{TranMenu}','PrintPodController@destroy')
         ->name('ScanOutPod.TranMenu.destroy')
         ->where('id', '[0-9]+');

	Route::get('/search', 'PrintPodController@Search');
	*/
});

Route::group(
     [
         'prefix' => 'reports','middleware' => ['auth']
     ], function () {
     
          Route::get('/pickup-summary', 'Reports\PickeupReportController@pickupsummary')
               ->name('pickupsummary.reports.index');

          Route::get('/pickup-details', 'Reports\PickeupReportController@pickupdetails')
               ->name('pickupdetails.reports.index');

          Route::get('/delivery-summary', 'Reports\PickeupReportController@deliverysummary')
               ->name('deliverysummary.reports.index');
          Route::get('/delivery-details', 'Reports\PickeupReportController@deliverydetails')
               ->name('deliverydetails.reports.index');

          Route::get('/rto-summary', 'Reports\PickeupReportController@rtosummary')
               ->name('rtosummary.reports.index');
          Route::get('/rto-details', 'Reports\PickeupReportController@rtodetails')
               ->name('rtodetails.reports.index');

          Route::get('/consolidated-summary', 'Reports\PickeupReportController@consolidatedsummary')
               ->name('consolidatedsummary.reports.index');
          Route::get('/consolidated-details', 'Reports\PickeupReportController@consolidateddetails')
               ->name('consolidateddetails.reports.index');

          Route::get('/export-excel-awb-pending', 'Reports\PickeupReportController@exportexcelawbpending')
          ->name('exportexcelawbpending.reports.index');
     });