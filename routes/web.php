<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomePageController;
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



Route::get('/', [HomePageController::class, 'welcome'])->name('welcome');
Route::get('/itemlist', [MenuItemController::class, 'index'])->name('itemlist');
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/category-add', [CategoryController::class, 'addCatogory'])->name('category.add');
    Route::post('/category-add', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/products', [ProductController::class, 'index'])->name('items.list');
    Route::get('/product-add', [ProductController::class, 'addItem'])->name('items.add');
    Route::post('/product-add', [ProductController::class, 'store'])->name('items.store');

    Route::get('/edit-product/{item}', [ProductController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ProductController::class, 'update'])->name('items.update');
    Route::get('/items/{item}', 'ItemController@show')->name('items.show');
    Route::delete('/items/{item}', 'ItemController@destroy')->name('items.destroy');



});

require __DIR__ . '/auth.php';
