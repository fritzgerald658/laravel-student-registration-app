<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/dashboard', [HomeController::class, 'adminLogin'])->name('admin.dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//  user admin routing
Route::get('/user-dashboard', [HomeController::class, 'userLogin'])->name('user.user-dashboard')->middleware(['auth', 'user']);
Route::get('/admin-dashboard', [HomeController::class, 'adminLogin'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::post('/admin-dashboard/store', [HomeController::class, 'storeStudents'])->name('admin.store');

// delete students data
Route::delete('/admin-dashboard/{students}', [HomeController::class, 'destroyStudents'])->name('admin.delete');

// fetch students data
Route::get('/admin-dashboard/{students}', [HomeController::class, 'fetchStudents'])->name('admin.fetch');

// update students data
Route::put('/admin-dashboard/{students}', [HomeController::class, 'updateStudents'])->name('admin.update');

Route::get('/filter-students/grade_level', [HomeController::class, 'filterStudents'])->name('admin.filterStudents');
