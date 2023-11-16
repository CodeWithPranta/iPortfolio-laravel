<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\AuthUserController::class, 'index'])->name('home')->middleware('verified');

Route::post('/send-message', [App\Http\Controllers\ContactController::class, 'sendMessage'])->name('send.message');

Route::get('/portfolio/{id}', [App\Http\Controllers\PortfolioController::class, 'singleRecord'])->name('portfolio.details');

Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles');

// Route::get('/articles/{id}', [App\Http\Controllers\ArticleController::class, 'singleArticle'])->name('single.article');
Route::get('/articles/{slug}', [App\Http\Controllers\ArticleController::class, 'singleArticle'])->name('single.article');
