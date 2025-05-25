<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RecipeController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:pendaftaran')->group(function () {
        Route::resource('patients', PatientController::class);
    });

    Route::prefix('examinations')->middleware('role:perawat,dokter')->group(function () {
        Route::get('', [ExaminationController::class, 'index'])->name('examinations.index');
        Route::get('/patient/{patient_id}/create', [ExaminationController::class, 'createExamination'])->name('examinations.create');
        Route::post('/patient/{patient_id}/store', [ExaminationController::class, 'storeExamination'])->name('examinations.store');
        Route::get('/{id}/edit', [ExaminationController::class, 'formExamination'])->name('examinations.form');
        Route::put('/{id}/update', [ExaminationController::class, 'updateExamination'])->name('examinations.updateExamination');
    });

    Route::get('medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('medicines/show/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');

    Route::prefix('medicines')->middleware('role:apoteker')->group(function () {
        // Route::get('/', [MedicineController::class, 'index'])->name('medicines.index');
        Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::get('/edit/{medicine}', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::post('/store', [MedicineController::class, 'store'])->name('medicines.store');
        Route::put('/{medicine}/update', [MedicineController::class, 'update'])->name('medicines.update');
        Route::delete('/{medicine}/destroy', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    });
});
