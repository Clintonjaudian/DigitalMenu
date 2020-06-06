<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('account', 'AccountController');

Route::prefix('/dashboard2')->namespace('dashboard2')->group(function()
{
    Route::group(['middleware' => ['auth']], function () 
    {
        Route::resource('upper', 'UpperController'); 
        Route::resource('lower_left', 'LowerLeftController');
        Route::resource('lower_right', 'LowerRightController');
        Route::resource('right_side', 'RightSideController');
        Route::post('right_side/add_on', 'RightSideController@add_on')->name('right_side.add_on');

        Route::resource('addon', 'RightSideAddonController');

        Route::get('menu_dashboard_2', 'MenuDashboard@index')->name('menu_dashboard_2');
        Route::post('addon_data', 'MenuDashboard@addon_data')->name('addon_data');
    });
});

Route::prefix('/menu1')->namespace('dashboard1')->group(function()
{
    Route::group(['middleware' => ['auth']], function () 
    {
        Route::resource('upper_left_menu1', 'UpperLeftController');
        Route::resource('upper_right_menu1', 'UpperRightController');
        Route::resource('lower_left_menu1', 'LowerLeftController');
        Route::resource('lower_right_menu1', 'LowerRightController');

        Route::get('menu1', 'MenuController@index')->name('menu1');
    });
});
