<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\AdminController;


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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', function() {
    return view('home');
})->name('home');

Route::group(['middleware' => ['auth']], function() {
    //Route::get('/home', 'HomeController@index')->name('home');
    
    // Admin routes
    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/admin', 'AdminController@index');
        Route::resource('users', 'UserController');
    });

    // Accountant routes
    Route::group(['middleware' => ['role:accountant']], function() {
        Route::get('/entries', 'EntryController@index');
        Route::resource('entries', 'EntryController');
    });
});
