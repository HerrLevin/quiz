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

use http\Env\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gamestatus/{id}', function($id) {
    return view('gamestatus', ['code' => $id]);
});

Route::get('/game/{id}', function($id) {
    return view('game_client', ['code' => $id]);
});

Route::get('/api/gamestatus', ['uses' => 'QuizController@getGameStatus', 'as' => 'api_gamestatus']);
Route::post('/api/gamestatus', ['uses' => 'QuizController@getGameStatus']);
Route::get('/api/answer', ['uses' => 'QuizController@makeAnswer']);

Route::get('/quizmaster', ['uses' => 'QuizController@getQuizMaster']);
Route::post('/quizmaster', ['uses' => 'QuizController@updateQuizMaster', 'as' => 'updatequiz']);
