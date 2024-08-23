<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');




Route::middleware(['ensure.authenticated'])->group(function () {
    Route::get('/profileClient/{id}', [HomeController::class, 'profileClient'])->name('profileClient');
    // Add other protected routes here =====================================================================================================================
});


Route::middleware(['admin'])->group(function () {
    // Админка ---
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // If you want to handle both GET and POST requests: =====================================================================================================================
    Route::match(['get', 'post'], '/admin/{id}', [AdminController::class, 'updateStatus'])->name('updateStatus');
    // Or if you only want to handle POST requests: =====================================================================================================================
    Route::post('/admin/{id}', [AdminController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/projects/update-task-status', [ProjectController::class, 'updateTaskStatus'])->name('projects.updateTaskStatus');
    Route::post('addUser', [HomeController::class, 'addUser'])->name('addUser');
    // Проекты --- =====================================================================================================================
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/project/create', [ProjectController::class, 'createProject'])->name('project.create');
    // Карбан и задачи --- =====================================================================================================================
    Route::get('/project/{id}', [ProjectController::class, 'projectshow'])->name('project.projectshow');
    Route::post('/update-task-status', [ProjectController::class, 'updateTaskStatus'])->name('updateTaskStatus');
    Route::post('/project/quest', [ProjectController::class, 'createQuest'])->name('project.quest');
    // In routes/web.php =====================================================================================================================
    Route::post('/projects/add-status', [ProjectController::class, 'addStatus'])->name('projects.addStatus');
    Route::get('/projects/{project_id}/tasks', [ProjectController::class, 'getTasks'])->name('getTasks');
    Route::get('/statuses', [ProjectController::class, 'getStatuses'])->name('getStatuses');
    Route::post('/project/{projectId}/upload-avatar', [ProjectController::class, 'uploadProjectAvatar'])->name('project.uploadAvatar');

// routes/web.php
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

    // routes/api.php=====================================================================================================================
    Route::get('/projects', [ProjectController::class, 'search'])->name('projects.search');
});

 // Профиль ---=====================================================================================================================
 Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
 Route::post('/profile/save-notes', [ProfileController::class, 'saveNotes'])->name('profile.saveNotes');

 Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');

 // =====================================================================================================================


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/verify-sms', [LoginController::class, 'showVerifyForm'])->name('verify.sms');
Route::post('/verify-sms', [LoginController::class, 'verifySms']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/resend-code', [LoginController::class, 'resendCode'])->name('resend.code');





if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
