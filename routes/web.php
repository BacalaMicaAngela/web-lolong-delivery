<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TilesController;
use App\Http\Controllers\AdminLinkController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\DriverContoller;
use App\Http\Controllers\LandingLinkController;
use App\Http\Controllers\MaintenaceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TruckContoller;
use App\Http\Controllers\RecycleBinController;

Route::get('/recycleBin', [RecycleBinController::class, 'showRecycleBinPage'])->middleware('isloggedIn');
Route::get('/recycleBin', [RecycleBinController::class, 'index'])->name('recycleBin');


Route::get('/', function () {
    return view('index');
});

Route::get('/admin-login', [AuthController::class, 'adminLogin'])->name('admin-login');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');

//login 
Route::get('/login', [AuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::post('login-user', [AuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [AuthController::class, 'pageView'])->middleware('isloggedIn');
Route::get('/pages', [TilesController::class, 'pageHome'])->middleware('isloggedIn');
Route::get('/logout', [AuthController::class, 'logout']);
//Admin
Route::post('update-user', [UserController::class, 'updateUser'])->name('update-user');
// user
Route::get('/adminUserLists', [AdminLinkController::class, 'userLists'])->middleware('isloggedIn');
Route::post('a_newUser', [UserController::class, 'manageUser'])->name('a_newUser');
Route::get('a_showUser/{id}', [UserController::class, 'showUser'])->name('a_showUser');
Route::post('destroyUser', [UserController::class, 'destroyUser'])->name('destroyUser');
Route::get('actionUser/{id}/{type}', [UserController::class, 'actionUser'])->name('actionUser');
Route::get('restoreUser/{id}', [UserController::class, 'restoreUser'])->name('restoreUser');


//deletedUser
Route::get('/adminUserLists', [AdminLinkController::class, 'userLists'])->middleware('isloggedIn');
Route::post('permanentlyDelete', [DeletedUserController::class, 'permanentlyDelete'])->name('permanentlyDelete');
// driver 
Route::get('/driver', [AdminLinkController::class, 'driver'])->middleware('isloggedIn');
Route::post('manageDriver', [DriverContoller::class, 'manageDriver'])->name('manageDriver');
Route::get('showDriver/{id}', [DriverContoller::class, 'showDriver'])->name('showDriver');
Route::post('destroyDriver', [DriverContoller::class, 'destroyDriver'])->name('destroyDriver');
Route::post('actionDriver/{id}/{type}', [DriverController::class, 'actionDriver'])->name('actionDriver');
Route::post('removeDriver/{id}', [DriverController::class, 'removeDriver'])->name('removeDriver');
Route::post('restoreDriver/{id}', [DriverController::class, 'restoreDriver'])->name('restoreDriver');

// truck units
Route::get('/truck', [AdminLinkController::class, 'truck'])->middleware('isloggedIn');
Route::post('manageTruck', [TruckContoller::class, 'manageTruck'])->name('manageTruck');
Route::get('showTruck/{id}', [TruckContoller::class, 'showTruck'])->name('showTruck');
Route::post('destroyTruck', [TruckContoller::class, 'destroyTruck'])->name('destroyTruck');
// deliver
Route::get('/records', [AdminLinkController::class, 'records'])->middleware('isloggedIn');
Route::post('manageDeliver', [DeliverController::class, 'manageDeliver'])->name('manageDeliver');
Route::get('showDeliver/{id}', [DeliverController::class, 'showDeliver'])->name('showDeliver');
Route::post('destroyDeliver', [DeliverController::class, 'destroyDeliver'])->name('destroyDeliver');
// schedule
Route::get('/schedule', [AdminLinkController::class, 'schedule'])->middleware('isloggedIn');
Route::get('/viewSched/{id}', [ScheduleController::class, 'viewsched']);
Route::post('manageSchedule', [ScheduleController::class, 'manageSchedule'])->name('manageSchedule');
Route::get('showSchedule/{id}', [ScheduleController::class, 'showSchedule'])->name('showSchedule');
Route::post('destroySchedule', [ScheduleController::class, 'destroySchedule'])->name('destroySchedule');
// maintenance
Route::get('/maintenace', [AdminLinkController::class, 'maintenace'])->middleware('isloggedIn');
Route::get('downloadMaintenace/{path}', [MaintenaceController::class, 'downloadMaintenace'])->name('downloadMaintenace');
Route::post('manageMaintenace', [MaintenaceController::class, 'manageMaintenace'])->name('manageMaintenace');
Route::get('showMaintenace/{id}', [MaintenaceController::class, 'showMaintenace'])->name('showMaintenace');
Route::post('destroyMaintenace', [MaintenaceController::class, 'destroyMaintenace'])->name('destroyMaintenace');
// billing state
Route::get('/billingState', [AdminLinkController::class, 'billingState'])->middleware('isloggedIn');
Route::get('downloadBill/{path}', [BillingController::class, 'downloadBill'])->name('downloadBill');
Route::post('manageBilling', [BillingController::class, 'manageBilling'])->name('manageBilling');
Route::get('showBilling/{id}', [BillingController::class, 'showBilling'])->name('showBilling');
Route::post('destroyBilling', [BillingController::class, 'destroyBilling'])->name('destroyBilling');
// settings
Route::get('/adminSettings', [AdminLinkController::class, 'adminSettings'])->middleware('isloggedIn');
Route::get('backupDatabase/{id}', [SettingsController::class, 'backupDatabase'])->name('isloggedIn');
Route::post('restoreDatabase', [SettingsController::class, 'restoreDatabase'])->name('restoreDatabase');

Route::get('/admin-login', 'AuthController@adminLogin')->name('admin-login');


