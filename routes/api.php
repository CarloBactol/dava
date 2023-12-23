<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeTreatment;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GcashController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\BookingUserController;
use App\Http\Controllers\ServicesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user_profile', [AuthController::class, 'user_profile']);
    Route::apiResource('services', ServicesController::class);
});

Route::post('forgot-password',  [AuthController::class, 'forgot_password']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('change-password',  [AuthController::class, 'change_password']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/name', [AuthController::class, 'name']);
// Route::resetPassword();

Route::post('/payment', [GcashController::class, 'gcash_payment']);
Route::get('/payment', [GcashController::class, 'payments']);
Route::post('/user_status', [GcashController::class, 'getUserEmail']);
Route::get('/account', [GcashController::class, 'getAccount']);

// Booking
Route::get('/bookings', [BookingUserController::class, 'index']);
Route::post('/post_bookings', [BookingUserController::class, 'postBooking']);
Route::get('/my_bookings/{email}', [BookingUserController::class, 'myBooking']);


Route::apiResource('home_treatments', HomeTreatment::class);

Route::post('/animal', [AnimalController::class, 'animal']);
Route::post('/medical_records', [AnimalController::class, 'medical_records']);
