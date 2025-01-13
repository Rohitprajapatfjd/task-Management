<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AccessBothMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//    --------------------------task work--------------------------
Route::middleware(AccessBothMiddleware::class)->group(function(){
Route::get('/add-task',[TaskController::class,'taskForm'])->name('task.form');
Route::get('/edit-task/{id}',[TaskController::class,'editForm'])->name('task.editForm');
Route::post('/edit-task-form/{id}',[TaskController::class,'editTaskForm'])->name('task.editFormDynamic');
Route::get('/delete-task-form/{id}',[TaskController::class,'DeleteTask'])->name('task.delete');
Route::post('/add-task-form',[TaskController::class,'Addtask'])->name('task.formAdd');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
