<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ManageController;

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
Route::post('/search', [ItemController::class, 'search']);
Route::get('/sell', [ItemController::class, 'sell']);
Route::post('/sell', [ItemController::class, 'sale']);
Route::get('/detail/{item_id}', [ItemController::class, 'detail'])->name('detail');

Route::get('/comment', [CommentController::class, 'comment']);
Route::post('/comment', [CommentController::class, 'post']);
Route::post('/comment/delete', [CommentController::class, 'comment_delete']);

Route::post('/favorite', [FavoriteController::class, 'favorite']);
Route::post('/comment/favorite', [FavoriteController::class, 'comment_favorite']);

Route::get('/mypage', [MypageController::class, 'mypage']);
Route::get('/mypage/profile', [MypageController::class, 'profile']);
Route::post('/mypage/profile', [MypageController::class, 'update']);

Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
Route::get('/purchase/payment/{item_id}', [PurchaseController::class, 'payment'])->name('purchase.payment');
Route::post('/purchase/payment/{item_id}', [PurchaseController::class, 'payment_update'])->name('purchase.payment_update');
Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address'])->name('purchase.address');
Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'address_update'])->name('purchase.address_update');
Route::get('/sold', [PurchaseController::class, 'sold'])->name('sold');
Route::get('/success', [PurchaseController::class, 'success']);
Route::get('/cancel/{buyer_id}', [PurchaseController::class, 'cancel']);

Route::get('/manage', [ManageController::class, 'manage'])->middleware('permission:manage');
Route::post('/manage/delete', [ManageController::class, 'delete']);
Route::post('/manage/send', [ManageController::class, 'send']);