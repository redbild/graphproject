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

Route::get('/','GraphController@main');

//Get Data from Nep4J
Route::get('/getGraphList','GraphController@getGraphList');
Route::get('/getGraphData','GraphController@getGraphData');

//Import Data to Neo4J
Route::get('/createDatabase','GraphController@createDatabase');
Route::get('/deleteDatabase','GraphController@deleteDatabase');
Route::get('/importGraphData','GraphController@importGraphData');
