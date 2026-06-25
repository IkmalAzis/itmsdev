<?php

use App\Models\Developer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\ITMS\ProjectController;

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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => '/app', 'as' => 'app.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,"dashboard"])->name('dashboard');
    Route::resource('bu', BusinessUnitController::class)->middleware('can:isABU');
    Route::resource('profile', UserController::class);
    
    Route::group(['prefix' => '/itms', 'as' => 'itms.', 'middleware' => ['checkAdmin']], function () {
        Route::get('/dashboard', [App\Http\Controllers\ITMS\DashboardController::class,"dashboard"])->name('dashboard');
        // Route::resource('project', ProjectController::class)->middleware('can:isADev');
        // Route::resource('project', ProjectController::class)->middleware('can:isManagbunitphp er');
        Route::resource('project', ProjectController::class);
        Route::post('/project/attach-developers/{project}', [App\Http\Controllers\ITMS\ProjectController::class, "attachDevelopers"])->name('project.attachDevelopers');
        Route::post('/project/detach-developers/{project}', [App\Http\Controllers\ITMS\ProjectController::class, "detachDevelopers"])->name('project.detachDevelopers');
        Route::get('/project/progress/{project}', [App\Http\Controllers\ITMS\ProjectController::class,"progress"])->name('project.progress');
        Route::post('/project/progress/{project}', [App\Http\Controllers\ITMS\ProjectController::class,"progressprocess"])->name('project.progressprocess');

        // Route::get('progress', [App\Http\Controllers\ITMS\ProjectController::class,"progindex"])->name('progindex');
        // Route::get('progress/create', [App\Http\Controllers\ITMS\ProjectController::class,"progcreate"])->name('progcreate');
        // Route::post('progress', [App\Http\Controllers\ITMS\ProjectController::class,"progstore"])->name('progstore');

        Route::resource('system', SystemController::class)->middleware('can:isManager');
        Route::resource('developer', DeveloperController::class);
    });
});
