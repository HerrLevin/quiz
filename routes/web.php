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
})->name('welcome');

Route::get('/gamestatus/{id}', function($id) {
    return view('gamestatus', ['code' => $id]);
});

Route::get('/game/{id}', function($id) {
    if (session('username') == '') {
        return redirect()->route('welcome');
    }
    return view('game_client', ['code' => $id]);
})->name('gameclient');

Route::get('/login', ['uses' => 'QuizController@login', 'as' => 'login']);
Route::get('/logout', ['uses' => 'QuizController@logout', 'as' => 'logout']);

Route::get('/api/gamestatus', ['uses' => 'QuizController@getGameStatus', 'as' => 'api_gamestatus']);
Route::post('/api/gamestatus', ['uses' => 'QuizController@getGameStatus']);
Route::post('/api/answer', ['uses' => 'QuizController@makeAnswer', 'as' => 'api_answer']);
Route::get('/api/answer', ['uses' => 'QuizController@makeAnswer', 'as' => 'api_answer']);

Route::get('/quizmaster', ['uses' => 'QuizController@getQuizMaster']);
Route::post('/quizmaster', ['uses' => 'QuizController@updateQuizMaster', 'as' => 'updatequiz']);
