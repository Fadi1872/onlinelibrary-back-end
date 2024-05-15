<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
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

Route::middleware('auth')->group(function () {
    Route::middleware('adminAccess')->group(function () {
        Route::get('/', [BooksController::class, 'index']);
        Route::resource('/books', BooksController::class)->except(['show']);
        Route::get('/books/create/{category}', [BooksController::class, 'create_book'])->name('books.create_book');
        Route::get('/books/edit/{category}/{id}', [BooksController::class, 'edit_book'])->name('books.edit_book');
        Route::resource('/categories', CategoriesController::class)->except(['show']);
        Route::resource('/subcategories', SubCategoriesController::class)->except(['show']);
    });
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
