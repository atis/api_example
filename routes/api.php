<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('survey/{survey}/response/{response}/question/{question}/text/{id?}', 'App\Http\Controllers\Api\AnswerController@putText');
Route::put('survey/{survey}/response/{response}/question/{question}/int/{id?}', 'App\Http\Controllers\Api\AnswerController@putInt');
Route::put('survey/{survey}/response/', 'App\Http\Controllers\Api\AnswerController@putSurveyResponse');
//Route::put('survey/{survey}/complete/', 'App\Http\Controllers\Api\AnswerController@putSurveyComplete');

Route::get('stats/question/average/{survey?}', 'App\Http\Controllers\Api\StatsController@getQuestionAverage');
Route::get('stats/question/count/{survey?}', 'App\Http\Controllers\Api\StatsController@getQuestionCount');
Route::get('stats/option/count/{survey?}', 'App\Http\Controllers\Api\StatsController@getOptionCount');


