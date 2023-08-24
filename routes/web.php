<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,'index'])->name('home.index');
Route::get('/doctors/{major_id?}', [DoctorController::class, 'index'])->name('doctor.index');
// majors
Route::get('/majors', [MajorController::class, 'index'])->name('major.index');
Route::get('/major/index',[MajorController::class,'index2'])->name('major.index2');
Route::get('/major/create',[MajorController::class,'create'])->name('major.create');
Route::post('/major/store',[MajorController::class,'store'])->name('major.store');
Route::get('/major/edit/{major}',[MajorController::class,'edit'])->name('major.edit');
Route::put('/major/update/{major}',[MajorController::class,'update'])->name('major.update');
Route::delete('/major/delete/{major}',[MajorController::class,'destroy'])->name('major.delete');

//doctors
Route::get('/doctor/index',[DoctorController::class,'index2'])->name('doctor.index2');
Route::get('/doctor/create',[DoctorController::class,'create'])->name('doctor.create');
Route::post('/doctor/store',[DoctorController::class,'store'])->name('doctor.store');
Route::get('/doctor/edit/{doctor}',[DoctorController::class,'edit'])->name('doctor.edit');
Route::put('/doctor/update/{doctor}',[DoctorController::class,'update'])->name('doctor.update');
Route::delete('/doctor/delete/{doctor}',[DoctorController::class,'destroy'])->name('doctor.delete');

//booking
Route::get('/booking/create/{id}',[BookingController::class,'create'])->name('booking.create');
Route::post('/booking/store/{id}',[BookingController::class,'store'])->name('booking.store');

//users
Route::get('/user/index',[UserController::class,'index2'])->name('user.index2');
Route::get('/user/create',[UserController::class,'create'])->name('user.create');
Route::post('/user/store',[UserController::class,'store'])->name('user.store');
Route::get('/user/edit/{user}',[UserController::class,'edit'])->name('user.edit');
Route::put('/user/update/{user}',[UserController::class,'update'])->name('user.update');
Route::delete('/user/delete/{user}',[UserController::class,'destroy'])->name('user.delete');



Route::get('/dashboard', [AdminDashboardController::class,'dashboard'])
->middleware(['auth', 'verified','check.admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';
