<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperTeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PressReleaseController;
use App\Http\Controllers\MailController;


Route::get('/register', function () {
    return view('pages.auth.registerTalent');
});
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

// Login
Route::get('/sign-in', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/sign-in', [AuthController::class, 'login'])->name('signin.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile/{username}', [UserController::class, 'show'])->name('user-profile.get');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard.get');

    Route::get('/admin/user-client', [UserController::class, 'showUserClient'])->name('admin.show-user-client.get');
    Route::get('/search-users', [UserController::class, 'searchClient'])->name('search-users');

    Route::get('/admin/create-user', [UserController::class, 'createUserClient'])->name('admin.create-user.client.get');
    Route::post('/admin/create-user', [UserController::class, 'postCreateUserClient'])->name('admin.create-user.client.post');

    Route::get('/admin/edit-user/{id}', [UserController::class, 'editUserClient'])->name('admin.edit-user.client.get');
    Route::post('/admin/update-user/{id}', [UserController::class, 'updateUserClient'])->name('admin.update-user.client.post');

    Route::post('/admin/block-user/{id}', [UserController::class, 'blockUser'])->name('admin.block-user.post');

    Route::get('/admin/super-team', [SuperTeamController::class, 'index'])->name('admin.super-team.get');
    Route::get('/search-projects', [SuperTeamController::class, 'searchProjects'])->name('search-projects');
    Route::get('/admin/super-team/create', [SuperTeamController::class, 'create'])->name('admin.create-super-team.get');
    Route::post('/admin/super-team/create', [SuperTeamController::class, 'store'])->name('admin.create-super-team.post');

    Route::get('/admin/super-team/complete-projects/{id}', [SuperTeamController::class, 'completeProject'])->name('admin.complete-project-super-team.get');
    Route::get('/search-pm', [SuperTeamController::class, 'searchPM'])->name('search-pm');
    Route::get('/search-team', [SuperTeamController::class, 'searchTeam'])->name('search-team');
    Route::post('/store-project-team', [SuperTeamController::class, 'storeProjectTeam'])->name('store-project-team');

    Route::get('/admin/super-team/{id}', [ProjectController::class, 'show'])->name('admin.super-team.show.get');
    Route::post('/admin/super-team/tasks/store/{id_project}', [ProjectController::class, 'addTask'])->name('admin.super-team.tasks.store');
    Route::post('/tasks/update-status/{id}', [ProjectController::class, 'updateStatus'])->name('tasks.update-status');

    Route::get('/admin/press-release', [PressReleaseController::class, 'index'])->name('admin.pr.get');
    Route::get('/admin/press-release/create', [PressReleaseController::class, 'create'])->name('admin.create-pr.get');
    Route::post('/admin/press-release/store', [PressReleaseController::class, 'store'])->name('admin.store-pr.post');
    Route::get('/admin/press-release/edit/{id}', [PressReleaseController::class, 'edit'])->name('admin.edit-pr.get');
    Route::post('/admin/press-release/update/{id}', [PressReleaseController::class, 'update'])->name('admin.update-pr.post');
    Route::get('/admin/press-release/detail/{id}', [PressReleaseController::class, 'show'])->name('admin.show-pr.get');
    Route::post('/admin/press-release/delete/{id}', [PressReleaseController::class, 'delete'])->name('admin.delete-pr.post');


});


// Writer Dashboard
// Route::middleware(['role:writer'])->group(function () {
//     Route::get('/writer/dashboard', [WriterController::class, 'dashboard'])->name('writer.dashboard');
// });

// Talent Dashboard
Route::middleware(['role:talent'])->group(function () {
    Route::get('/talent/dashboard', function () {
        return view('pages.dashboard.talent.dashboard');
    })->name('talent.dashboard');
});

// Company Dashboard
Route::middleware(['auth', 'role:company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'index'])->name('company.dashboard.get');
    Route::get('/company/dashboard/detail/{id}', [CompanyController::class, 'show'])->name('company.super-team.show.get');
});


Route::get('/select-pakage', function () {
    return view('pages.client.pakage.index');
});

Route::post('/submit-form', [MailController::class, 'submitForm'])->name('submit.form');