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
Route::get('/NewLog', 'MainController@newLog')->name('newLog');	
Route::get('/DataTable', 'MainController@DataTable')->name('newLog');	
Route::get('/', 'MainController@allLog')->name('allLog');	

