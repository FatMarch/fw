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

Route::get('/feed/get', 'SmallProgram\\FeedBack@getFeedInfo');
Route::post('/feed/post', 'SmallProgram\\FeedBack@postFeed');

Route::get('/cal/get', 'SmallProgram\\Calendar@getDayInfo');

