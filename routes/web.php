<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageContrloller;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SuperAdmin;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;




Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('home', [HomeController::class, 'home'])
    ->name('home')->middleware('user');

Route::post('home/search', [HomeController::class, 'search'])
    ->name('home.search')->middleware('user');

Route::post('articles/search', [AdminController::class, 'search'])
    ->name('articles.search');
Route::post('admins/search', [AdminController::class, 'SearchForUser'])
    ->name('admins.search');

Route::post('UserArticle/search', [HomeController::class, 'UserArticleSearch'])
    ->name('UserArticle.search')->middleware('user');


Route::get('articles/category/{id}', [HomeController::class, 'category'])
    ->name('articles.category')->middleware('user');

Route::get('user/articles/category/{writer_id}/{cat_id}', [HomeController::class, 'category_user'])
    ->name('user.category')->middleware('user');

Route::get('user/articles/{id}', [HomeController::class, 'UserArticles'])
    ->name('user.articles')->middleware('user');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admins/showall', [AdminController::class, 'alladmins'])
    ->name('admins.showall')->middleware('admin');

Route::get('users', [AdminController::class, 'getusers'])
    ->name('users.showall')->middleware('admin');

Route::get('users/showall', [AdminController::class, 'allusers'])
    ->name('allusers.showall')->middleware('admin');

Route::resource('admins', AdminController::class)->middleware('admin');
Route::resource('admins', AdminController::class)->only(['create', 'store'])->middleware('SuperAdmin');

Route::post('mail', [MessageContrloller::class, 'send'])
    ->name('mail.send');

Route::get('articles/pending', [ArticleController::class, 'pending_articles'])
    ->name('pending')->middleware('admin');

Route::get('articles/approved', [ArticleController::class, 'approved_articles'])
    ->name('approved')->middleware('admin');

Route::get('articles/rejected', [ArticleController::class, 'rejected_articles'])
    ->name('rejected')->middleware('admin');


Route::get('articles/add', [ArticleController::class, 'add'])
    ->name('articles.add')->middleware(['auth']);
Route::resource('articles', ArticleController::class)->middleware(['auth']);




Route::resource('category', CategoryController::class)->middleware('admin');

Route::resource('comments', CommentController::class)->middleware('user');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ProfileController::class, 'update_image'])->name('profile.update_image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
