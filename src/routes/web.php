<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;

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

Route::get('/', [ItemController::class, 'index']);
Route::get('/sell', [ItemController::class, 'sell']);
Route::post('/sell', [ItemController::class, 'sale']);
Route::get('/detail/{item_id}', [ItemController::class, 'detail'])->name('detail');
Route::post('/favorite', [ItemController::class, 'favorite']);
Route::get('/comment', [ItemController::class, 'comment']);
Route::post('/comment', [ItemController::class, 'post']);
Route::post('/comment/favorite', [ItemController::class, 'comment_favorite']);

Route::get('/mypage', [MypageController::class, 'mypage']);
Route::get('/mypage/profile', [MypageController::class, 'profile']);
Route::post('/mypage/profile', [MypageController::class, 'update']);
