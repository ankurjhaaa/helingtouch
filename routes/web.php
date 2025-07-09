<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoscontactController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\UserappointmentController;
use Illuminate\Support\Facades\Route;


Route::controller(HoscontactController::class)->group(function () {
    Route::get('/hospital-contact', 'index')->name('landing.hospital-contact');
    Route::post('/hospital-contact', 'store')->name('landing.hospital-contact.store');
});
Route::controller(PublicController::class)->group(function () {
    Route::get('/register', 'home')->name('public.register');
    Route::post('/register/apply', 'userregister')->name('public.register.apply');
    Route::get('/register/login', 'showLogin')->name('showlogin');
    Route::post('/register/userlogin', 'userLogin')->name('userlogin');
});
Route::middleware(['auth', 'role:user'])->controller(UserappointmentController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('landing.dashboard');
    Route::get('/userhistory', 'userhistory')->name('landing.userhistory');
    Route::post('/insertuserhistory', 'insertuserhistory')->name('landing.insertuserhistory');

}); 

Route::get('/appointmentrecipt/{id}', [AppointmentController::class, 'downloadReceipt'])->name('receipt.download');


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/appointment', 'appointment')->name('appointment');


    Route::get('/manage-appointments', 'manageappointments')->name('manageappointments');
    Route::get('/services', 'services')->name('services');
    Route::post('/manage-appointments/{id}/insertotp', 'insertotp')->name('landing.insertotp');
    Route::post('/manage-appointments/{id}/verifyotp', 'verifyotp')->name('landing.verifyotp');
    Route::get('/book-appointment/{id}', 'bookAppointment')->name('bookAppointment');
    Route::get('/success-appointment', 'successappointment')->name('successappointment');
    Route::post('/insert-appointment', 'insertAppointment')->name('insertAppointment');
    Route::get('/our-doctor', 'alldoctor')->name('landing.our-doctor');
    Route::get('/doctor/{id}', 'doctorprofile')->name('landing.doctor');
    Route::get('/doctor-profile/{id}', 'doctorprofileview')->name('landing.doctor-profile');
    Route::get('/gallery', 'ourGallery')->name('landing.gallery');
    Route::get('/myappointment', 'myappointment')->name('landing.myappointment');
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
    Route::get('/admin/gallery', 'gallery')->name('admin.gallery');
    Route::post('/admin/gallery/store', 'storeGallery')->name('admin.gallery.store');
    Route::delete('/admin/gallery/delete/{id}', 'deleteGallery')->name('admin.gallery.delete');
    Route::get('/admin/edit-gallery/{id}', 'editGallery')->name('admin.gallery.edit');
    Route::put('/admin/update-gallery/{id}', 'updateGallery')->name('admin.gallery.update');
    Route::get('/admin/seeting', 'seetings')->name('admin.seeting');
    Route::post('/admin/seeting/store', 'saveSeetings')->name('admin.seeting.store');
    Route::post('/admin/seeting/information', 'information')->name('admin.seeting.information');
    Route::get('/admin/leave', 'viewLeave')->name('admin.docleave');
    Route::put('/admin/leaves/{id}', 'updateLeaveStatus')->name('admin.leave.approve');
    Route::get('/admin/profile', 'viewAdminProfile')->name('admin.profile');
    Route::get('/admin/manageappointments', 'manageAppointment')->name('admin.manageappointments');
    Route::post('/admin/manageappointments/{id}/upsate-status', 'updateStatus')->name('admin.updatestatus');
    Route::get('/admin/{id}/edit-appointment', 'editAppointments')->name('admin.editappointments');
    Route::put('/admin/{id}/updateappointment', 'updateAppointment')->name('admin.updateappointments');
    Route::delete('/admin/{id}/deleteappointments', 'destroyAppointments')->name('admin.deleteappointments');
    Route::get('/admin/{id}/apppointments-recipts', 'generateRecipt')->name('admin.appointments-receipt');
    Route::get('/admin/staff-list', 'staffIndex')->name('admin.stafflist');
    Route::post('/admin/storestaff', 'storeStaff')->name('admin.storestaff');
    Route::delete('/admin/{id}/staff-delete', 'destroyStaff')->name('admin.staff-delete');
    Route::get('/admin/{id}/edit-Staff', 'editStaff')->name('admin.edit-staff');
    Route::put('/admin/{id}/upadet-staff', 'updateStaff')->name('admin.staff-update');
    Route::get('/admin/givesalary', 'givesalary')->name('admin.givesalary');
    Route::post('/admin/insertgivesalary', 'insertgivesalary')->name('admin.insertgivesalary');

});


Route::middleware(['auth', 'role:doctor'])->controller(DoctorController::class)->group(function () {
    Route::get('/doc', 'home')->name('doctor.dashboard');
    Route::get('/doc/profile', 'doctorprofile')->name('doctor.profile');
    Route::get('/doc/patient/{id}', 'patient')->name('doctor.patient');
    Route::post('/doc/appointments/{id}/complete', 'markCompleted')->name('appointments.complete');
    Route::get('/doc/leave', 'showLeaveForm')->name('doctor.leave');
    Route::post('/doc/leave/store', 'submitLeave')->name('doctor.leave.store');
    Route::post('/doc/insertuserhistory', 'insertuserhistory')->name('doctor.insertuserhistory');

});

Route::middleware(['auth', 'role:receptionist'])->controller(ReceptionistController::class)->group(function () {
    Route::get('/recption/home', 'land')->name('receptionist.Dashboard');
    Route::get('/recption/profile', 'recptionprofile')->name('receptionist.profile');
    Route::get('/recption/attendance', 'attendance')->name('receptionist.attendance');
    Route::post('/recption/makeattendance', 'makeattendance')->name('receptionist.makeattendance');
    Route::get('/recption/addappointment/{id}', 'addappointment')->name('receptionist.addappointment');
    Route::post('/recption/insert-appointment', 'insertAppointment')->name('recption.insertAppointment');
    Route::get('/recption/appointmentview/{id}', 'appointmentview')->name('reception.appointmentview');
    Route::post('/appointments/{id}/approve', 'approve')->name('appointments.approve');
    Route::post('/appointments/{id}/in-progress', 'markInProgress')->name('appointments.in_progress');
    Route::post('/appointments/{id}/check-in', 'markCheckedIn')->name('appointments.checkin');
    Route::post('/appointments/{id}/complete', 'markCompleted')->name('appointments.complete');
    Route::post('/appointments/{id}/pay', 'markPaid')->name('appointments.pay');
    Route::post('/appointments/{id}/resedule', 'resedule')->name('reception.resedule');
    Route::post('/appointments/{id}/followup', 'followup')->name('reception.followup');
    

});


    Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/logout', 'logoutUser')->name('auth.logout');
});



// --------------------------- razorpay ka route ----------------------------------------
Route::post('/payment', [RazorpayController::class, 'payment'])->name('payment');
Route::post('/appointments/{id}/cancle', [RazorpayController::class, 'cancle'])->name('appointments.cancle');
