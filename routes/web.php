<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


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
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/courses', [ProfileController::class, 'index'])->name('course');

// Route to show the form for adding a new course
Route::get('/courses/create', [ProfileController::class, 'create'])->name('course_add');

// Route to store a new course
Route::post('/courses', [ProfileController::class, 'store']);

// Route to show a specific course for editing
Route::get('/courses/{id}/edit', [ProfileController::class, 'course_edit'])->name('course_edit');

// Route to update an existing course
Route::put('/courses/{id}', [ProfileController::class, 'course_update']);

// Route to delete a course
Route::delete('/courses/{id}', [ProfileController::class, 'course_destroy']);


//Routing for instructor

// Route to display the form for adding a new instructor
Route::get('/instructors/add', [ProfileController::class, 'showAddInstructorForm'])->name('showAddInstructorForm');

// Route to store the new instructor in the database
Route::post('/instructors', [ProfileController::class, 'saveNewInstructor'])->name('saveNewInstructor');

// Route to list all instructors
Route::get('/instructor', [ProfileController::class, 'listInstructors'])->name('instructor');

// Route to display the form for editing an instructor
Route::get('/instructors/edit/{id}', [ProfileController::class, 'showEditInstructorForm'])->name('showEditInstructorForm');

// Route to update instructor information
Route::put('/instructors/{id}', [ProfileController::class, 'updateInstructorInfo'])->name('updateInstructorInfo');

// Route to delete an instructor
Route::delete('/instructors/delete/{id}', [ProfileController::class, 'deleteInstructor'])->name('deleteInstructor');


// Route to list all users
Route::get('/users', [ProfileController::class, 'listUsers'])->name('users');

// Route to show the form for adding a new user
Route::get('/users/add', [ProfileController::class, 'showAddUserForm'])->name('showAddUserForm');

// Route to store a new user
Route::post('/users', [ProfileController::class, 'saveNewUser'])->name('saveNewUser');

// Route to display the form for editing a user
Route::get('/users/edit/{id}', [ProfileController::class, 'showEditUserForm'])->name('showEditUserForm');

// Route to update user information
Route::put('/users/{id}', [ProfileController::class, 'updateUserInfo'])->name('updateUserInfo');

// Route to delete a user
Route::delete('/users/delete/{id}', [ProfileController::class, 'deleteUser'])->name('deleteUser');


//For chart in dashboard



