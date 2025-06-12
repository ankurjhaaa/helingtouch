<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
  
});
Route::middleware(['auth', 'role:admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin/addrole', 'showform')->name('admin.addrole');
    Route::post('/admin/apply', 'submitform')->name('admin.applySubmit');
    Route::get('/admin/admindashboard', 'adminDashboard')->name('admin.Dashboard');
});
Route::middleware(['auth', 'role:doctor'])->controller(DoctorController::class)->group(function(){
    Route::get('/doctor/home', 'home')->name('doctor.Dashboard');
});

Route::middleware(['auth', 'role:receptionist'])->controller(ReceptionistController::class)->group(function(){
    Route::get('/recption/home', 'land')->name('receptionist.Dashboard');
});


Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/logout', 'logoutUser')->name('auth.logout');
});