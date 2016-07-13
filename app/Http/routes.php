<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'Main\MainController@Index');             //default route

Route::get('dropbox', 'Dropbox\DropboxController@Index');              //default dropbox view
Route::post('dropbox', 'Dropbox\DropboxController@store');             //save image
Route::get('dropbox/{id}', 'Dropbox\DropboxController@edit');          //show  file
Route::post('dropbox/{id}', 'Dropbox\DropboxController@update');       //edit file
Route::delete('dropbox/{id}', 'Dropbox\DropboxController@destroy');    //delete file


