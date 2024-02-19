<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\RegisterController;
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



Route::get('listallbill', [BillController::class, 'index'])->name('viewbills');

Route::post('register', [RegisterController::class, 'create'])->name('billing');








Route::post('userregister', [UserController::class, 'register']);

Route::post('verify-otp', [UserController::class, 'verifyOtp']);

Route::post('user-login', [UserController::class, 'login']);

Route::get('user/{username}/pdf', [UserController::class, 'generateUserDetailsPdf']);



