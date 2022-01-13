<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AktivitetesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/abouts', [AboutController::class, 'index'])->name('about.index');
Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');
Route::get('/hyrje/{about}', [AboutController::class, 'show'])->name('about.show');
Route::post('/about/store', [AboutController::class, 'store'])->name('about.store');
Route::get('/about/{about}', [AboutController::class, 'edit'])->name('about.edit');
Route::put('/about/{about}', [AboutController::class, 'update'])->name('about.update');
Route::delete('/about/{about}', [AboutController::class, 'destroy'])->name('about.delete');

Route::get('/categories', [CategoriesController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.create');
Route::get('/categoria/{category}', [CategoriesController::class, 'show'])->name('category.show');
Route::post('/category/store', [CategoriesController::class, 'store'])->name('category.store');
Route::get('/category/{category}', [CategoriesController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}', [CategoriesController::class, 'update'])->name('category.update');
Route::delete('/category/{category}', [CategoriesController::class, 'destroy'])->name('category.delete');

Route::get('/projects', [ProjectsController::class, 'index'])->name('project.index');
Route::get('/project/create', [ProjectsController::class, 'create'])->name('project.create');
Route::post('/project/store', [ProjectsController::class, 'store'])->name('project.store');
Route::get('/project/{project}', [ProjectsController::class, 'edit'])->name('project.edit');
Route::get('/proj/{project}', [ProjectsController::class, 'show'])->name('project.show');
Route::put('/project/{project}', [ProjectsController::class, 'update'])->name('project.update');
Route::delete('/project/{project}', [ProjectsController::class, 'destroy'])->name('project.delete');

// media
// Route::post('projects/media', 'ProjectsController@storeMedia')
Route::post('projects/media', [ProjectsController::class, 'storeMedia'])->name('projects.storeMedia');

Route::get('/aktivitete', [AktivitetesController::class, 'index'])->name('aktivitet.index');
Route::get('/aktivitet/create', [AktivitetesController::class, 'create'])->name('aktivitet.create');
Route::post('/aktivitet/store', [AktivitetesController::class, 'store'])->name('aktivitet.store');
Route::get('/akt/{aktivitete}', [AktivitetesController::class, 'show'])->name('aktivitet.show');
Route::get('/aktivitet/{aktivitete}', [AktivitetesController::class, 'edit'])->name('aktivitet.edit');
Route::put('/aktivitet/{aktivitete}', [AktivitetesController::class, 'update'])->name('aktivitet.update');
Route::delete('/aktivitet/{aktivitete}', [AktivitetesController::class, 'destroy'])->name('aktivitet.delete');


// Route::post('/projects/media', 'ProjectsController@storeMedia')->name('projects.storeMedia');
Route::post('/projects/media', [ProjectsController::class, 'storeMedia'])->name('projects.storeMedia');

Route::get('/paneli', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
