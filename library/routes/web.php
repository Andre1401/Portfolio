<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/dashboard', App\Http\Controllers\HomeController::class);
Route::resource('/catalogs', App\Http\Controllers\CatalogController::class);
// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// Route::get('/catalogs/create', [App\Http\Controllers\CatalogController::class, 'create']);
// Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
// Route::get('/catalogs/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
// Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
// Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);

Route::resource('/publishers', App\Http\Controllers\PublisherController::class);
// Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
// Route::get('/publishers/create', [App\Http\Controllers\PublisherController::class, 'create']);
// Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
// Route::get('/publishers/{publisher}/edit', [App\Http\Controllers\PublisherController::class, 'edit']);
// Route::put('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'update']);
// Route::delete('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'destroy']);

Route::resource('/authors', App\Http\Controllers\AuthorController::class);
Route::resource('/members', App\Http\Controllers\MemberController::class);
Route::resource('/books', App\Http\Controllers\BookController::class);
Route::resource('/transactions', App\Http\Controllers\TransactionController::class);

Route::get('/api/authors', [App\Http\Controllers\AuthorController::class, 'api']);
Route::get('/api/publishers', [App\Http\Controllers\PublisherController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/books', [App\Http\Controllers\BookController::class, 'api']);
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);

Route::get('test_spatie', [AdminController::class, 'test_spatie']);