<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FillDataController;
use App\Http\Controllers\ProgectsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\PersonalInfoController;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/progects', [ProgectsController::class, 'getProgects']);
    Route::get('/education', [EducationController::class, 'getEducations']);
    Route::get('/contacts', [ContactsController::class, 'getContacts']);
    Route::get('/certificates', [CertificatesController::class, 'getCertificates']);
    Route::get('/personal_infos', [PersonalInfoController::class, 'getPersonalInfo']);
    Route::get('/skills', [SkillsController::class, 'getSkills']);
    Route::post('/createSkill', [SkillsController::class, 'createSkill']);
});
Route::prefix('/user')->group(function () {
    Route::post('/register', [UserController::class, 'validator']);
    Route::post('/setDataJson', [FillDataController::class, 'saveFileJson']);
    Route::post('/sendCode', [UserController::class, 'sendEmailCode']);
    Route::post('/resetPassword', [UserController::class, 'resetPassword']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/logout', [UserController::class, 'logout']);
        Route::post('/getInfo', [UserController::class, 'getUser']);
    });
    
});
