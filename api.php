<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
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

    //Route::get('/demo' , [DemoController::class , 'index']);
    
    Route::get('/user' , [UserController::class , 'index']);        
    //Route::get('/user/{id}' , [UserController::class , 'showSingle']);        
    Route::post('/user/store' , [UserController::class , 'store']);        
    Route::post('/user/update/{id}' , [UserController::class , 'update']);        
    Route::delete('/user/delete/{id}' , [UserController::class , 'delete']);        
    Route::post('/user/upload-image' , [UserController::class , 'uploadImage']);        
    Route::get('/user/list/{id?}' , [UserController::class , 'optionalPara']);        
    Route::get('user/search/{name?}', [UserController::class , 'Search']);
