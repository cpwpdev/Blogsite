<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;


use Illuminate\Http\Request;


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

Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
 
Route::get('/login', function () {
    return view('login');
})->name('login');
// Route::get('/register', function () {
//     return view('register');
// })->name('register');

// Route::get('/register', [AuthController::class,'register'])->name('register');

Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register')->middleware('guest');
Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('login')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');

 
Route::resource('posts',PostsController::class)->except([
    'index'
])->middleware('auth');
 