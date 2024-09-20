<?php

use App\Http\Controllers\SurveyAnswerController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyEventController;
use App\Http\Controllers\SurveyQuestionController;
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

//survey routes

Route::prefix('survey')->group(function () {
    Route::post('/', [SurveyController::class, 'createSurvey']);
    Route::get('/', [SurveyController::class, 'getSurvey']);
});

//survey question routes
Route::prefix('survey-question')->group(function () {
    Route::post('/', [SurveyQuestionController::class, 'createSurveyQuestion']);
    Route::get('/', [SurveyQuestionController::class, 'getSurveyQuestion']);
});

//survey answer routes
Route::prefix('survey-answer')->group(function () {
    Route::post('/', [SurveyAnswerController::class, 'createSurveyAnswer']);
    Route::get('/', [SurveyAnswerController::class, 'getSurveyAnswer']);
});

//survey event routes
Route::prefix('survey-event')->group(function () {
    Route::post('/', [SurveyEventController::class, 'createSurveyEvent']);
    Route::get('/', [SurveyEventController::class, 'getSurveyEvent']);
    Route::get('/result', [SurveyEventController::class, 'eventResult']);

});
