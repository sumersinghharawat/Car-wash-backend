<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderBookingController;
use App\Http\Controllers\SendCustomerOtp;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

// Customer
Route::post('/customer-register', [CustomerController::class, 'register'])->middleware('guest');

Route::post('/customer-login', [CustomerController::class, 'login'])->middleware('guest');

Route::post('/sendcustomerotp', [SendCustomerOtp::class, 'sendotp'])->middleware('guest');

Route::post('/customer-forgot-password', [CustomerController::class, 'forgotPassword'])->middleware('guest');


// Open APIs

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
    
    // API Customer
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // API Customer
    Route::post('/profile', [HomeController::class,'updateprofile']);
    
    Route::post('/customer-logout', [CustomerController::class, 'remove_token']);
    
    Route::get('/profile/{phone}', [CustomerController::class, 'api_profile']);
    
    Route::post('/updateprofile', [CustomerController::class, 'api_updateprofile']);
    
    Route::post('/customer-change-password', [CustomerController::class, 'api_ChangePassword']);
    
    // API Category
    Route::get('/categories', [CategoryController::class, 'api_category'])->name("category");
    
    Route::get('/categories/{id}', [CategoryController::class, 'api_subcategory'])->name("subcategory");
    
    Route::post('/addcategory', [CategoryController::class, 'api_addcategory']);
    
    Route::post('/categorystatus', [CategoryController::class, 'api_categorystatus']);
    
    Route::post('/deletecategory', [CategoryController::class, 'deletecategory']);
    
    // API Employee
    Route::post('/addemployee', [EmployeeController::class, 'api_addemployee']);

    Route::post('/employeestatus', [EmployeeController::class, 'api_employeestatus']);

    Route::post('/updateemployee', [EmployeeController::class, 'api_updateemployee']);

    Route::post('/deleteemployee', [EmployeeController::class, 'api_deleteemployee']);
    
    Route::get('/viewemployee', [EmployeeController::class, 'api_viewemployee']);

    Route::get('/viewemployee/{id}', [EmployeeController::class, 'api_viewemployee']);
    
    // API Service
    Route::post('/addservice', [ServiceController::class, 'api_addservice'])->name('addservice');
    
    Route::post('/servicestatus', [ServiceController::class, 'api_servicestatus']);
    
    Route::post('/deleteservices', [ServiceController::class, 'api_deleteservice']);
    
    Route::post('/updateservice', [ServiceController::class, 'api_updateservice'])->name("updateservice");
    
    Route::get('/viewservice/{category}', [ServiceController::class, 'api_viewservice']);
    
    Route::get('/viewservice/{category}/{id}', [ServiceController::class, 'api_viewservice']);

    //Booking Stol
    Route::post('/booking-slot', [OrderBookingController::class, 'api_booking_slot']);

    Route::post('/order-now', [OrderBookingController::class, 'api_order_now']);

    Route::post('/order-confirm', [OrderBookingController::class, 'order_confirm']);

    Route::get('/orders/{id}', [OrderBookingController::class, 'api_orders']);

    Route::get('/transaction/{id}', [OrderBookingController::class, 'api_transaction']);

    Route::post('/deleteorder', [OrderBookingController::class, 'api_deleteorder']);

    Route::post('/deleteorder', [OrderBookingController::class, 'api_deleteorder']);

    
    
});
