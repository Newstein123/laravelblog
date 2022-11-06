<?php

use PhpParser\Node\Stmt\Label;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Admin\LabelController;
use App\Http\Controllers\admin\AuthorController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\AuthorProfileController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\authController;

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
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('isAdmin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Admin 
Route::resource('admin/posts', PostController::class)->middleware('isAdmin');

Route::resource('admin/profile', ProfileController::class)->middleware('isAdmin');

Route::resource('admin/passwordUpdate', PasswordController::class)->middleware('isAdmin');

Route::get('/admin/label/{id}/create', [LabelController::class, 'create'])->middleware('isAdmin');
Route::post('/admin/label/{id}', [LabelController::class, 'store'])->middleware('isAdmin');


Route::get('/', [FrontendController::class, 'index'])->name('Home');
Route::get('/post/{id}', [FrontendController::class, 'show'])->name('post_show');

Route::resource('admin/slider', SliderController::class);
Route::resource('admin/comment', AdminCommentController::class);

// User 

Route::get('admin/user', [UserController::class , 'index'])->middleware('isAdmin');
Route::get('admin/user/create', [UserController::class , 'create'])->middleware('isAdmin');
Route::post('admin/user', [UserController::class , 'store'])->middleware('isAdmin');
Route::get('admin/user/{id}', [UserController::class , 'show'])->middleware('isAdmin');
Route::get('admin/user/{id}/edit', [UserController::class , 'edit'])->middleware('isAdmin');
Route::put('admin/user/{id}', [UserController::class , 'update'])->middleware('isAdmin');
Route::delete('admin/user/{id}', [UserController::class , 'destroy'])->middleware('isAdmin');

// Author 

Route::resource('admin/author', AuthorController::class)->middleware('isAdmin');

// frontend author profile 

Route::get('/author/{id}', [AuthorProfileController::class, 'profile']);
Route::post('/author/review/{id}', [AuthorProfileController::class, 'review']);

// comment 

Route::get('/post/comment/{id}', [CommentController::class, 'create']);
Route::post('/post/comment', [CommentController::class, 'store']);
Route::get('/post/comment/{id}/edit', [CommentController::class, 'edit']);
Route::put('/post/comment/{id}', [CommentController::class, 'update']);
Route::delete('/post/comment/{id}', [CommentController::class, 'destroy']);

// Frontend Category 

Route::get('/category/{category}', [FrontendController::class, 'label']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Socail login 
// Googole 
Route::get('/auth/google/redirect', [authController::class, 'googleredirect'])->name('googleLogin');
Route::get('/auth/google/callback', [authController::class, 'googlecallback'])->name('googleCallback');

// facebook 
Route::get('/auth/facebook/redirect', [authController::class, 'facebookredirect'])->name('facebookLogin');
Route::get('/auth/facebook/callback', [authController::class, 'facebookcallback'])->name('facebookCallback');
