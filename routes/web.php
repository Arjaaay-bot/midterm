<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestMaterialsController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\admin;
use App\MaterialRequest;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

route::get('/',[HomeController::class,'index'])->middleware('auth')->name('home');
Route::middleware(['auth', 'admin'])->group(function () {
    

    Route::get('/projects', function () {
        return view('admin.project');
    })->name('projects');

    Route::get('/material', function () {
        return view('admin.materials');
    })->name('material');

    Route::get('/analytic', function () {
        return view('admin.analytics');
    })->name('analytic');
});

Route::middleware(['auth', 'verified'])->group(function () {
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
});

//Request Materials by Staff Routes
Route::post('/save-material', [RequestMaterialsController::class, 'store']);
Route::get('/requestmaterials', [RequestMaterialsController::class, 'list'])->name('requestmaterials');
Route::delete('/materials/{material}', [RequestMaterialsController::class, 'destroy'])->name('materials.destroy');
Route::put('/materials/{material}', [RequestMaterialsController::class, 'update'])->name('materials.update');

//Routes For Admin Inventory
Route::get('/material', [InventoryController::class, 'index'])->name('material');
Route::post('/add-inventory', [InventoryController::class, 'store'])->name('add-inventory');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('update-inventory');
Route::delete('/inventory/{id}', [InventoryController::class, 'delete']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
