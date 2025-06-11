<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
  
});
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/apply', 'showform')->name(name: 'admin.applyForm');
    Route::post('/admin/apply', 'submitform')->name('admin.applySubmit');
});