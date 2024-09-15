<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::controller(WebsiteController::class)->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/posts/{post}', 'show')->name('post.show');
});

Route::view('contact-us','website.contact')->name('contact');

Auth::routes();

Route::middleware('auth')->prefix('auth')->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');
    Route::resource('posts', PostController::class);
});
