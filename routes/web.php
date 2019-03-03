<?php
use Illuminate\Http\Request;


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

Route::get('/', 'TopPageController@top');

Route::post('register/pre_check', 'Auth\RegisterController@pre_check')
  ->name('register.pre_check');



Route::get('view', 'StockViewController@show')
  ->middleware('auth');

Route::post('make', 'StockViewController@post');



Route::get('make', 'MakeController@show')
  ->middleware('auth');

Route::post('make/add', 'MakeController@addStock');
Route::post('make/principal', 'MakeController@addPrincipal');
Route::post('make/cash', 'MakeController@addCash');

Route::delete('make/{stock}', 'MakeController@deleteStock');
Route::delete('make/principal/{asset}', 'MakeController@deletePrincipal');
Route::delete('make/cash/{bill}', 'MakeController@deleteCash');

Route::post('view', 'MakeController@post');

Route::get('ajaxtest', 'AjaxTestController@index');

Route::post('ajaxtest/aaa', 'AjaxTestController@ajaxTest');

Route::get('ajaxtest', 'AjaxTestController@printTest');

Route::auth();


?>
