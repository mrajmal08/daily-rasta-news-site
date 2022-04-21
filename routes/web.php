<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers as web;

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

Route::get('/home', [web\HomeController::class, 'index'])->name('home');
Route::get('/profile', [web\HomeController::class, 'profile'])->name('profile');
Route::post('/profile/update', [web\HomeController::class, 'profileUpdate'])->name('profile.update');
Route::post('/profile/update/password', [web\HomeController::class, 'profilePassword'])->name('profile.password');


Route::get('/logout', [web\Auth\LoginController::class, 'logout']);

//users Routs
Route::get('/users', [web\UserController::class, 'index'])->name('users.index');
Route::get('/user/create', [web\UserController::class, 'create'])->name('users.create');
Route::post('/user/store', [web\UserController::class, 'store'])->name('users.store');
Route::get('/user/edit/{id}', [web\UserController::class, 'edit'])->name('users.edit');
Route::post('/user/update/{id}', [web\UserController::class, 'update'])->name('users.update');
Route::get('/user/delete/{id}', [web\UserController::class, 'destroy'])->name('users.delete');



// Categoires Routes
Route::get('/categories', [web\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [web\CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [web\CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}  ', [web\CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{id}', [web\CategoryController::class, 'update'])->name('categories.update');
Route::get('/category/delete/{id}', [web\CategoryController::class, 'destroy'])->name('categories.destroy');

// News Route
Route::get('/news', [web\NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [web\NewsController::class, 'create'])->name('news.create');
Route::post('/news/store', [web\NewsController::class, 'store'])->name('news.store');
Route::get('/news/edit/{id}', [web\NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/update/{id}', [web\NewsController::class, 'update'])->name('news.update');
Route::get('/news/delete/{id}', [web\NewsController::class, 'destroy'])->name('news.delete');

