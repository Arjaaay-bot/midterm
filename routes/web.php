<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestMaterialsController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\admin;
use App\MaterialRequest;
use App\Http\Controllers\Admin\MaterialRequestController;
use App\Http\Controllers\Admin\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('home');
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Route::get('/home', function () {
    //     return view('admin.adminhome');
    // })->name('home');
    Route::post('projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    // Route::get('/projects', function () {
    //     return view('admin.project');
    // })->name('projects');

    Route::get('/material', function () {
        return view('admin.materials');
    })->name('material');

    Route::get('/requests', function () {
        return view('admin.requests');
    })->name('requests');

    Route::get('/analytic', function () {
        return view('admin.analytics');
    })->name('analytic');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    Route::get('/project', function () {
        return view('staff.project');
    })->name('project');

    Route::get('/materials', function () {
        return view('staff.materials');
    })->name('materials');

    Route::get('/requestmaterials', function () {
        return view('staff.requestmaterials');
    })->name('requestmaterials');

    Route::get('/analytics', function () {
        return view('staff.analytics');
    })->name('analytics');
    Route::get('/total-waiting-requests', [RequestMaterialsController::class, 'getTotalWaitingRequests']);
});

//Request Materials by Staff Routes
Route::post('/save-material', [RequestMaterialsController::class, 'store']);
Route::get('/requestmaterials', [RequestMaterialsController::class, 'list'])->name('requestmaterials');
Route::delete('/materials/{material}', [RequestMaterialsController::class, 'destroy'])->name('materials.destroy');
Route::put('/materials/{material}', [RequestMaterialsController::class, 'update'])->name('materials.update');

//Routes For Admin Inventory
Route::get('/material', [InventoryController::class, 'index'])->name('material');
Route::get('/analytic', [InventoryController::class, 'analyticsView'])->name('analytic');
Route::get('/analytics', [InventoryController::class, 'generateReportStaff'])->name('analytics');
Route::post('/add-inventory', [InventoryController::class, 'store'])->name('add-inventory');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('update-inventory');
Route::delete('/inventory/{id}', [InventoryController::class, 'delete']);


//Routes for viewing Request Materials by staff
Route::get('/materials', [RequestMaterialsController::class, 'index'])->name('materials');
Route::put('/inventory/{id}/reduce-quantity', [InventoryController::class, 'reduceQuantity']);

//Routes for Dashboard staff/admin
Route::get('/total-inventories', [InventoryController::class, 'getTotalInventories']);
Route::get('/total-requests', [RequestMaterialsController::class, 'getTotalRequests']);
Route::get('/total-projects', [ProjectController::class, 'getTotalProjects']);

//Routes for Analytics staff/admin
Route::get('/chart-data', [RequestMaterialsController::class, 'getChartStatusData']);
Route::get('/chart-inventory', [InventoryController::class, 'getChartInventoryData']);

//Routes for predicting number of projects next month
Route::get('/next-month-analytics', [ProjectController::class, 'nextMonthAnalytics']);


Route::middleware('auth', 'admin')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/requests', [MaterialRequestController::class, 'index'])->name('admin.requests');
Route::put('/requests/{id}/accept', [MaterialRequestController::class, 'accept'])->name('admin.requests.accept');
Route::put('/requests/{id}/decline', [MaterialRequestController::class, 'decline'])->name('admin.requests.decline');
});
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
require __DIR__.'/auth.php';
