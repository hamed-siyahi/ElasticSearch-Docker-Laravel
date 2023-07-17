<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
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


Route::get('/', [SearchController::class,'searchData'])->name('home');
Route::get('/search/user-posts', [SearchController::class,'getPostByUserId'])->name('search.user-posts');
Route::get('/search/user-users', [SearchController::class,'searchUsers'])->name('search.users');

