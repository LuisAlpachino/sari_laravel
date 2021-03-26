<?php

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

// Route::get('/', function () {
//     return view('welcolme');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/reports-day', function () {
    return view('layouts.dashboard.reports-day');
})->middleware(['auth'])->name('reports-day');

Route::get('/notes', function () {
    return view('layouts.dashboard.note');
})->middleware(['auth'])->name('notes');

Route::get('/medias', function () {
    return view('layouts.dashboard.media');
})->middleware(['auth'])->name('medias');

Route::get('/history', function () {
    return view('layouts.dashboard.history');
})->middleware(['auth'])->name('history');

Route::get('/configurations', function () {
    return view('layouts.dashboard.config');
})->middleware(['auth'])->name('configurations');



require __DIR__.'/auth.php';
