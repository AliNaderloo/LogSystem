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
Route::get('/DataTable/{role}/{id}', 'DataTable@DataTableAll')->name('allDataTabelLogs');	
Route::get('/NewLog/{json}', 'MainController@newLog')->name('newLog');
Route::get('/UserLog/{userId}', 'MainController@userLogs')->name('userLogs');	
Route::get('/DataTableAll', 'MainController@DataTableAll')->name('allDataTabelLogsIndex');	
Route::get('/', 'MainController@allLog')->name('allLog');	
Route::get('/DataTableFields/{id}', 'MainController@fieldsLog')->name('fieldsLog');
Route::get('/TableLog/{tableId}', 'MainController@tableLogs')->name('tablerLogs');
