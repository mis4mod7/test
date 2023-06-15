<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/chatrooms', [ChatroomController::class, 'index'])->name('chatrooms.index');
Route::get('/chatrooms/{id}', [ChatroomController::class, 'show'])->name('chatroom.show');
Route::post('/chatrooms/{id}/messages', [MessageController::class, 'store'])->name('chatroom.messages.store');

Route::get('/transfer', [BalanceController::class, 'showTransferForm'])->name('transfer.form');
Route::post('/transfer', [BalanceController::class, 'transfer'])->name('transfer.submit');

Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');

Route::get('/account/history', [TransactionController::class , 'accountHistory'])->name('account.history');

Route::post('/assets/{asset}', [AssetController::class,'purchase'])->name('assets.purchase');

Route::get('/assets', [AssetController::class,'index'])->name('assets.index');

Route::get('/pets', [PetController::class,'index'])->name('pets.index');
Route::post('/pets/{pet}', [PetController::class, 'purchase'])->name('pets.purchase');
Route::post('/pets/{pet}/feed', [PetController::class, 'feed'])->name('pets.feed');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/pets', [UserController::class, 'showPets'])->name('users.pets.show');


Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');

Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');








