<?php

use App\Http\Controllers\SurveyController;
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

