<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('schoolClass', SchoolClassController::class);
Route::resource('students', StudentController::class);

Route::get('/get-classes/{year}', [StudentController::class, 'getClasses']);
Route::get('/get-students/{classId}', [StudentController::class, 'getStudentsByClass']);


Route::resource('subjects', SubjectController::class);
Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::get('/get-classes/{year}', [StudentController::class, 'getClasses']);

require __DIR__.'/auth.php';
