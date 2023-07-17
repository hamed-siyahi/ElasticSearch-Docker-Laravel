<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiSearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search/user-posts', [ApiSearchController::class,'getPostByUserId']);
Route::get('/search/users', [ApiSearchController::class,'searchUsers']);
Route::get('/search/publish-rate', [ApiSearchController::class,'postsByDate']);
Route::get('/search/age-average', [ApiSearchController::class,'avgAgeQuery']);
Route::get('/search/posts', [ApiSearchController::class,'searchPostByKeyWords']);
