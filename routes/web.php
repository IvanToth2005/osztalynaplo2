<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Routes
Route::resource('school-class', SchoolClassController::class);
Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('marks', MarkController::class);

// Custom Routes for Students
Route::get('/students/by-class/{classId}', [StudentController::class, 'getStudentsByClass'])->name('students.by-class');
Route::get('/get-classes/{year}', [StudentController::class, 'getClasses'])->name('get-classes');

// Custom Routes for Classes
Route::get('/classes/{year}', [SchoolClassController::class, 'getByYear']);

// Marks Routes
Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
Route::put('/marks/{mark}', [MarkController::class, 'update'])->name('marks.update');

// Subject Routes
Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/get-classes/{year}', [SubjectController::class, 'getClasses'])->name('subjects.get-classes');
    Route::get('/get-subjects/{classId}', [SubjectController::class, 'getSubjects'])->name('subjects.get-subjects');
});

// Display results for subjects
Route::post('/subjects/show-results', [SubjectController::class, 'showResults'])->name('subjects.show-results');

Route::get('/get-students/{classId}', [StudentController::class, 'getStudentsByClass'])->name('students.get-students');
Route::get('/get-classes/{year}', [StudentController::class, 'getClasses']);

// routes/web.php
Route::resource('school-class', 'App\Http\Controllers\SchoolClassController');
require __DIR__.'/auth.php';