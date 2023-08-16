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
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout']);;
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::group([
      'middleware' => ['auth:sanctum']
  ],function (){
    Route::post('/edit_profile',[UserController::class,'showProfile']);
    Route::post('/update_profile',[UserController::class,'updateProfile']);
    
    Route::post('/update-profile', [UserController::class ,'updateProfile']);
    // Route::post('/update-multi-image', [imageController::class ,'uploadUserImage']);
  });
