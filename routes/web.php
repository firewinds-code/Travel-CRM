<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });


    ############################ Dashboard Routes ###############################
    Route::get('/dashboard', [UserController::class, 'show'])->name('dashboard');

    ############################ Manage User Routes ###############################

    Route::get('changepassword', [ManageUserController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ManageUserController::class, 'updatepassword'])->name('updatepassword');

    ############################ Portal Routes ###############################
    Route::get('portal/view', [PortalController::class, 'view'])->name('portal.view');
    Route::post('portal/details', [PortalController::class, 'details'])->name('portal.details');
    
    Route::middleware(['requester'])->group(function () {
    Route::get('portal/edit', [PortalController::class, 'editRequests'])->name('portal.edit');
    Route::get('portal/table', [PortalController::class, 'table'])->name('portal.table');
    Route::post('portal/update', [PortalController::class, 'update'])->name('portal.update');
    Route::get('portal/delete', [PortalController::class, 'delete'])->name('portal.delete');
    Route::get('portal/report', [PortalController::class, 'report'])->name('portal.report');
    });
    ############################ Approver Routes ###############################
    Route::middleware(['approver'])->group(function () {
        Route::get('approver/table', [ApproverController::class, 'table'])->name('approver.table');
        Route::get('approver/report', [ApproverController::class, 'report'])->name('approver.report');
        Route::get('approver/view', [ApproverController::class, 'view'])->name('approver.view');
        Route::get('approver/edit', [ApproverController::class, 'editRequests'])->name('approver.edit');
        Route::post('approver/update', [ApproverController::class, 'update'])->name('approver.update');
    });
    ############################ Admin Routes ###############################

    Route::middleware(['admin'])->group(function () {

        Route::get('admin/table', [AdminController::class, 'table'])->name('admin.table');
        Route::get('admin/report', [AdminController::class, 'report'])->name('admin.report');
        Route::get('admin/view', [AdminController::class, 'view'])->name('admin.view');
        Route::get('admin/edit', [AdminController::class, 'editRequests'])->name('admin.edit');
        Route::post('admin/update', [AdminController::class, 'update'])->name('admin.update');
        Route::get('manageuser/list', [ManageUserController::class, 'list'])->name('manageuser.list');
        Route::get('manageuser/add', [ManageUserController::class, 'add'])->name('manageuser.add');
        Route::post('manageuser/postadd', [ManageUserController::class, 'postadd'])->name('manageuser.postadd');
        Route::get('manageuser/edit', [ManageUserController::class, 'editUser'])->name('manageuser.edit');
        Route::post('manageuser/update', [ManageUserController::class, 'update'])->name('manageuser.update');
        Route::get('manageuser/delete', [ManageUserController::class, 'delete'])->name('manageuser.delete');
    });
});