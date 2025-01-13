
<?php

use App\Http\Controllers\adminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::controller(adminController::class)->group(function(){
    Route::get('/adminform','AdminForm')->name('AdminForm');
    Route::post('/adminlogin','AdminLogin')->name('AdminLogin');
    Route::middleware(AdminMiddleware::class)->group(function(){
      Route::get('/admin/dashboard','AdminDashboard')->name('admin.dashboard');
      Route::get('/admin/logout','AdminLogout')->name('admin.logout');
    });
});