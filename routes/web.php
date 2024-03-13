<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('person')->name('person')->group(function () {
    Route::get('/', 'PersonController@index')->name('.index');
    Route::get('/create', 'PersonController@create')->name('.create');
    Route::post('/store', 'PersonController@store')->name('.store');
    Route::get('/{person}/show', 'PersonController@show')->name('.show');
    Route::get('/{person}/edit', 'PersonController@edit')->name('.edit');
    Route::put('/{person}/update', 'PersonController@update')->name('.update');
    Route::delete('/{person}/destroy', 'PersonController@destroy')->name('.destroy');
});

Route::middleware(['auth'])->prefix('business')->name('business')->group(function () {
    Route::get('/', 'BusinessController@index')->name('.index');
    Route::get('/create', 'BusinessController@create')->name('.create');
    Route::post('/store', 'BusinessController@store')->name('.store');
    Route::get('/{business}/show', 'BusinessController@show')->name('.show');
    Route::get('/{business}/edit', 'BusinessController@edit')->name('.edit');
    Route::put('/{business}/update', 'BusinessController@update')->name('.update');
    Route::delete('/{business}/destroy', 'BusinessController@destroy')->name('.destroy');
});


require __DIR__.'/auth.php';
