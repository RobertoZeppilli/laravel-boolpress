<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Autenticazione con annullamento registrazione
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// rotte admin
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');
        Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
        Route::get('/tags/{tag}', 'TagController@show')->name('tags.show');
    });

// rotte pubbliche
Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');