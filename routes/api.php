<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoiceToTextController;

Route::prefix('speech-to-text')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/transcribe', [VoiceToTextController::class, 'transcribe']);

    Route::group(['middleware' => ['auth:user-api']], function () {
        Route::post('/logout',[UserController::class, 'logout']);
        Route::prefix('patients')->group( function () {
            Route::get('/', [PatientController::class, 'getPatients']);
            Route::get('/{id}', [PatientController::class, 'getDataOfPatientById']);
        });
    });
});
