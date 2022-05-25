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


//front end routes
Route::get('/', [web\FrontendController::class, 'index']);
Route::get('ہمارے-بارے-میں', [web\FrontendController::class, 'about'])->name('about.us');
Route::get('/ہم-سے-رابطہ-کریں', [web\FrontendController::class, 'contact'])->name('contact.us');
Route::post('/message-send', [web\FrontendController::class, 'contactStore'])->name('contact.store');

Route::get('/اقسام', [web\FrontendController::class, 'categories'])->name('categories.frontend');
Route::get('/{slug}/خبریں', [web\FrontendController::class, 'categoryDetail'])->name('categories.detail');
Route::get('/{slug}/خبر', [web\FrontendController::class, 'newsDetail'])->name('news.detail');
Route::get('/کالمز', [web\FrontendController::class, 'blog'])->name('blog');
Route::get('/{slug}/کالمز', [web\FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/قوائد-و-ضوابط', [web\FrontendController::class, 'terms'])->name('terms');
Route::get('/پرائیویسی-پالیسی', [web\FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/سٹاف', [web\FrontendController::class, 'staff'])->name('staff');

Route::get('/search', [web\FrontendController::class, 'search'])->name('search');

Route::post('/post-review', [web\FrontendController::class, 'postReview'])->name('post.review');

// post review route
Route::post('/review/store', [web\Frontend\ReviewController::class, 'store'])->name('review.store');
Route::get('/guest', [web\Frontend\ReviewController::class, 'guest'])->name('guest');

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

// News Routes
Route::get('/news', [web\NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [web\NewsController::class, 'create'])->name('news.create');
Route::post('/news/store', [web\NewsController::class, 'store'])->name('news.store');
Route::get('/news/edit/{id}', [web\NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/update/{id}', [web\NewsController::class, 'update'])->name('news.update');
Route::get('/news/delete/{id}', [web\NewsController::class, 'destroy'])->name('news.delete');


// Ads Routes
Route::get('/ads', [web\AdsController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [web\AdsController::class, 'create'])->name('ads.create');
Route::post('/ads/store', [web\AdsController::class, 'store'])->name('ads.store');
Route::get('/ads/edit/{id}', [web\AdsController::class, 'edit'])->name('ads.edit');
Route::post('/ads/update/{id}', [web\AdsController::class, 'update'])->name('ads.update');
Route::get('/ads/delete/{id}', [web\AdsController::class, 'destroy'])->name('ads.delete');

// Video Route
Route::get('/videos', [web\VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [web\VideoController::class, 'create'])->name('videos.create');
Route::post('/videos/store', [web\VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/edit/{id}', [web\VideoController::class, 'edit'])->name('videos.edit');
Route::post('/videos/update/{id}', [web\VideoController::class, 'update'])->name('videos.update');
Route::get('/videos/delete/{id}', [web\VideoController::class, 'destroy'])->name('videos.delete');

//Blogs Route
Route::get('/blogs', [web\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [web\BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs/store', [web\BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/edit/{id}', [web\BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/update/{id}', [web\BlogController::class, 'update'])->name('blogs.update');
Route::get('/blogs/delete/{id}', [web\BlogController::class, 'destroy'])->name('blogs.delete');


// NewsPaper Routes
Route::get('/newspaper', [web\NewspaperController::class, 'index'])->name('newspaper.index');
Route::get('/newspaper/create', [web\NewspaperController::class, 'create'])->name('newspaper.create');
Route::post('/newspaper/store', [web\NewspaperController::class, 'store'])->name('newspaper.store');
Route::get('/newspaper/edit/{id}', [web\NewspaperController::class, 'edit'])->name('newspaper.edit');
Route::post('/newspaper/update/{id}', [web\NewspaperController::class, 'update'])->name('newspaper.update');
Route::get('/newspaper/delete/{id}', [web\NewspaperController::class, 'destroy'])->name('newspaper.delete');


// Gallary Images Routes
Route::get('/gallary', [web\GallaryController::class, 'index'])->name('gallary.index');
Route::get('/gallary/create', [web\GallaryController::class, 'create'])->name('gallary.create');
Route::post('/gallary/store', [web\GallaryController::class, 'store'])->name('gallary.store');
Route::get('/gallary/edit/{id}', [web\GallaryController::class, 'edit'])->name('gallary.edit');
Route::post('/gallary/update/{id}', [web\GallaryController::class, 'update'])->name('gallary.update');
Route::get('/gallary/delete/{id}', [web\GallaryController::class, 'destroy'])->name('gallary.delete');


Route::post('/gallary/items', [web\GallaryController::class, 'gallaryItems'])->name('gallary.items');

