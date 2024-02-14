<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
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
Route::get('/sell', [ItemController::class, 'sell']);
Route::post('/sell', [ItemController::class, 'sale']);
Route::get('/detail/{item_id}', [ItemController::class, 'detail'])->name('detail');
Route::post('/favorite', [ItemController::class, 'favorite']);
Route::get('/comment', [ItemController::class, 'comment']);
Route::post('/comment', [ItemController::class, 'post']);
Route::post('/comment/favorite', [ItemController::class, 'comment_favorite']);
Route::post('/comment/delete', [ItemController::class, 'comment_delete']);

Route::get('/mypage', [MypageController::class, 'mypage']);
Route::get('/mypage/profile', [MypageController::class, 'profile']);
Route::post('/mypage/profile', [MypageController::class, 'update']);

Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
Route::get('/purchase/payment/{item_id}', [PurchaseController::class, 'payment'])->name('purchase.payment');
Route::post('/purchase/payment/{item_id}', [PurchaseController::class, 'payment_update'])->name('purchase.payment_update');
Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address'])->name('purchase.address');
Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'address_update'])->name('purchase.address_update');

Route::get('/sold', [PurchaseController::class, 'sold']);
Route::get('/success/{item_id}/{method}', [PurchaseController::class, 'success']);
Route::get('/cancel/{buyer_id}', [PurchaseController::class, 'cancel']);

Route::get('/manage', [ManageController::class, 'manage']);
Route::post('/manage/delete', [ManageController::class, 'delete']);
Route::post('/manage/send', [ManageController::class, 'send']);