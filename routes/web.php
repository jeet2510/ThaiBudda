<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itemlist', [MenuItemController::class, 'index'])->name('itemlist');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__ . '/auth.php';
