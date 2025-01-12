<?php

use Illuminate\Support\Facades\Route;

/** for side bar menu active */
function set_active($route) {
    if (is_array($route )){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}
/** for side bar menu show */
function set_show($route) {
    if (is_array($route )){
        return in_array(Request::path(), $route) ? 'show' : '';
    }
    return Request::path() == $route ? 'show' : '';
}

Route::get('/', function () {
    if(auth()->check())
        return redirect('home');

    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('dashboard.home');
    });
    Route::get('home',function()
    {
        return view('dashboard.home');
    });
});

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Auth'],function()
{
    // -----------------------------login----------------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    Route::group(['middleware' => ['auth']], function () {
        // -------------------------- main dashboard ----------------------//
        Route::controller(HomeController::class)->group(function () {
            Route::get('/home', 'index')->name('home');
        });

        // -------------------------- pages ----------------------//
        Route::controller(AccountController::class)->group(function () {
            Route::get('page/account/{user_id}', 'profileDetail');
        });

        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::prefix('accounts')->group(function(){
                Route::controller(App\Http\Controllers\AccountController::class)->group(function(){
                    Route::get('/', 'index')->name('accounts');
                });
            });
        });

        // -------------------------- hr ----------------------//
        Route::prefix('hr/')->group(function () {
            Route::controller(HRController::class)->group(function () {
                Route::get('employee/list', 'employeeList')->name('hr/employee/list');
                Route::post('employee/save', 'employeeSaveRecord')->name('hr/employee/save'); // save employee record
                Route::post('employee/update', 'employeeUpdateRecord')->name('hr/employee/update'); // update employee record
                Route::post('employee/delete', 'employeeDeleteRecord')->name('hr/employee/delete'); // delete employee record
                
                Route::get('holidays/page', 'holidayPage')->name('hr/holidays/page');
                Route::post('holidays/save', 'holidaySaveRecord')->name('hr/holidays/save'); // save or update record
                Route::post('holidays/delete', 'holidayDeleteRecord')->name('hr/holidays/delete'); // delete record
                
                Route::get('leave/employee/page', 'leaveEmployee')->name('hr/leave/employee/page');
                Route::get('create/leave/employee/page', 'createLeaveEmployee')->name('hr/create/leave/employee/page');
                Route::post('create/leave/employee/save', 'saveRecordLeave')->name('hr/create/leave/employee/save');
                Route::get('view/detail/leave/employee/{staff_id}', 'viewDetailLeave');
                
                Route::get('leave/hr/page', 'leaveHR')->name('hr/leave/hr/page');
                Route::get('attendance/page', 'attendance')->name('hr/attendance/page');
                Route::get('create/leave/hr/page', 'createLeaveHR')->name('hr/create/leave/hr/page');

                Route::post('get/information/leave', 'getInformationLeave')->name('hr/get/information/leave');
            
                Route::get('attendance/main/page', 'attendanceMain')->name('hr/attendance/main/page');
                Route::get('department/page', 'department')->name('hr/department/page');
                Route::post('department/save', 'saveRecorddepartment')->name('hr/department/save');
                Route::post('department/delete', 'deleteRecorddepartment')->name('hr/department/delete');
            });
        });
    });
});


