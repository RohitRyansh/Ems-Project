<?php

use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\UserAttendenceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->is_employee) {
            
            return to_route ('employees.index');
        }
         
        return to_route ('users.index');
    }

    return to_route ('login');
});

Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'index')->name('login');
        
        Route::post('/login', 'userAuthentication')->name('users.authentication');
        
    });

    Route::get ('/set-password/{user:slug}', [SetPasswordController::class, 'index'])->name('setpassword.index');

    Route::post ('/set-password/{user:slug}', [SetPasswordController::class, 'store'])->name('setpassword');
});

Route::middleware('auth')->group(function () {
    
    Route::controller(UserController::class)->group(function () {
        
        Route::get ('/users/listing','index')->name ('users.index');
        
        Route::get ('/users/create', 'create')->name ('users.create');
        
        Route::post ('/users/store', 'store')->name ('users.store');
        
        Route::get ('/users/{user:slug}/edit', 'edit')->name ('users.edit');
        
        Route::post ('/users/{user}/update', 'update')->name ('users.update');
        
        Route::delete ('/users/{user}/delete', 'delete')->name ('users.delete');
        
        Route::get ('/users/Requests/listing','leaveRequest')->name ('users.requests.index');
    
    });


    Route::controller(UserAttendenceController::class)->group(function () {
        
        Route::get ('/employees', 'index')->name ('employees.index');
        
        Route::get ('/employees/attendence', 'store')->name ('employees.attendence.store');
        
    });

    Route::get ('/logout', [LoginController::class, 'logout'])->name('users.logout');

    Route::post ('/users/{user}/active', [UserStatusController::class, 'userStatus'])->name('users.status');

    Route::get ('/employees/leave/create', [EmployeeLeaveController::class, 'create'])->name('employees.leaves.create');

    Route::post ('/employees/leave/store', [EmployeeLeaveController::class, 'store'])->name('employees.leaves.store');

    Route::get ('/employees/leaves/approved/{leave}', [LeaveManagementController::class, 'store'])->name('leaves.request.store');

    Route::get ('/employees/leaves/reject/{leave}', [LeaveManagementController::class, 'delete'])->name('leaves.request.delete');

});





