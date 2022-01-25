<?php

use App\Http\Controllers\AngularController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderBookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Models\Category;
use App\Models\OrderBooking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return redirect("/login");
    // });
    Route::any('/customer-login', [AngularController::class, 'index']);
    
    // Route::get('/',function(){ return view('booking_form'); })->name('booking_form');
    
    Route::get('/login', function () {
        return view('auth.login');
    });
    
    
    Route::get('/privacy-policy',[PageController::class,'privacy_policy'])->name('privacy_policy');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('guest');
    
    // Angular
    Route::any('/', [AngularController::class, 'index']);
    Route::any('/order', [AngularController::class, 'index']);
    Route::any('/home', [AngularController::class, 'index']);
    Route::any('/category', [AngularController::class, 'index']);
    Route::any('/subcategory', [AngularController::class, 'index']);
    Route::any('/booking', [AngularController::class, 'index']);
    Route::any('/orders', [AngularController::class, 'index']);
    Route::any('/transaction', [AngularController::class, 'index']);
    

    

Route::middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    Route::get('/profile',[HomeController::class,'profile'])->name('profile');
    // Category
    Route::get('/addcategory',[CategoryController::class,'addcategory'])->name('addcategory');
    Route::get('/category/{id}',[CategoryController::class,'editcategory'])->name('editcategory');
    Route::get('/viewcategory',[CategoryController::class,'viewcategory'])->name('viewcategory');

    // Employee
    Route::get('/addemployee',[EmployeeController::class,'addemployee'])->name('addemployee');
    Route::get('/addemployee/{id}',[EmployeeController::class,'addemployee'])->name('addemployee');
    Route::get('/viewemployee',[EmployeeController::class,'viewemployee'])->name('viewemployee');

    // Employee
    Route::get('/addservices',[ServiceController::class,'addservice'])->name('addservice');
    Route::get('/editservice/{id}',[ServiceController::class,'addservice'])->name('editservice');
    Route::get('/viewservice',[ServiceController::class,'viewservice'])->name('viewservice');

    // Orders
    Route::get('/orders',[OrderBookingController::class,'vieworders'])->name('vieworders');
});


require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
