<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/appointment', 'appointment')->name('appointment');
    Route::get('/book-appointment/{id}', 'bookAppointment')->name('bookAppointment');
    Route::post('/insert-appointment','insertAppointment')->name('insertAppointment');
});
Route::middleware(['auth', 'role:admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin/addrole', 'showform')->name('admin.addrole');
    Route::get('/admin/viewrole', 'viewrole')->name('admin.viewrole'); 
    Route::get('/admin/profile', 'adminprofile')->name('admin.profile');
    Route::get('/admin/department', 'adddepartment')->name('admin.department');
    Route::post('/admin/apply', 'submitform')->name('admin.applySubmit');
    Route::get('/admin/admindashboard', 'adminDashboard')->name('admin.Dashboard');
    Route::put('/admin/update/{id}', 'updateRole')->name('admin.updateRole');
    Route::delete('/admin/delete/{id}', 'deleteUser')->name('admin.deleteRole');
    Route::post('/admin/adddepartment', 'storedepartment')->name('admin.adddepartment');
    Route::delete('/admin/department/delete/{id}', 'deleteDepartment')->name('admin.department.delete');
    Route::get('/admin/department/edit/{id}', 'editDepartment')->name('admin.department.edit');
    Route::post('/admin/department/update/{id}', 'updateDepartment')->name('admin.department.update');
    Route::get('/admin/managedoctor', 'manageDoctor')->name('admin.manageDoctor');
    Route::post('/admin/adddoctor', 'storeDoctor')->name('admin.addDoctor');
    Route::delete('/admin/doctor/{doctor}', 'deleteDoctor')->name('admin.doctor.delete');
    Route::get('/admin/doctors/{doctor}/edit', 'edit')->name('admin.doctor.edit');
    Route::put('/admin/doctor/update/{doctor}', 'updateDoctor')->name('admin.doctor.update');




});
Route::middleware(['auth', 'role:doctor'])->controller(DoctorController::class)->group(function () {
    Route::get('/doctor/home', 'home')->name('doctor.Dashboard');
    Route::get('/doctor/profile', 'doctorprofile')->name('doctor.profile');
});

Route::middleware(['auth', 'role:receptionist'])->controller(ReceptionistController::class)->group(function () {
    Route::get('/recption/home', 'land')->name('receptionist.Dashboard');
    Route::get('/recption/profile', 'recptionprofile')->name('receptionist.profile');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/logout', 'logoutUser')->name('auth.logout');
});