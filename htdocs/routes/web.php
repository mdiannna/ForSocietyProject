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
    return view('index');
});




Route::get('/alert-map', 'AlertMapController@putMarkers');
Route::post('/save-alert-marker', 'AlertMapController@saveMarker');

// Route::get('/sensor-data/{data}', 'SensorDataController@index');
Route::get('/sensor-data', 'SensorDataController@index');

// Route::get('/sentiment-analysis/{data}', 'SentimentAnalysisController@index');
Route::get('/sentiment-analysis', 'SentimentAnalysisController@index');
Route::get('/sentiment-analysis/{text}/json', 'SentimentAnalysisController@json');

Route::get('/alert-info', 'AlertInfoController@index');