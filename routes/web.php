<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/reports-day', function () {
    return view('layouts.dashboard.reports-day');
})->middleware(['auth'])->name('reports-day');

// Rutas dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/reports/month/{year}/{month}', [ReportController::class, 'reportMonthPie'])->middleware(['auth'])->where('year', '[0-9]+')->where('month', '[0-9]+')->name('reports.month');
Route::get('/reports/year/{year}', [ReportController::class, 'reportYear'])->middleware(['auth'])->where('year', '[0-9]+')->name('reports.year');

// Rutas reportes

Route::get('/reports', [ReportController::class, 'allReportsEditor'])->middleware(['auth'])->name('reports.editor');
Route::get('/report-detail/{id}', [ReportController::class, 'detail'])->middleware(['auth'])->name('report.detail')->where('id', '[0-9]+');
Route::get('/new-report', [ReportController::class, 'create'])->middleware(['auth'])->name('create.report');
Route::get('/edit-report/{id}', [ReportController::class, 'edit'])->middleware(['auth'])->name('edit.report')->where('id', '[0-9]+');
Route::post('/save-report', [ReportController::class, 'save'])->middleware(['auth'])->name('save.report');
Route::get('/delete-report/{id}', [ReportController::class, 'delete'])->middleware(['auth'])->name('delete.report')->where('id', '[0-9]+');
Route::get('/history', [ReportController::class, 'history'])->middleware(['auth'])->name('history.reports');
Route::post('/search', [ReportController::class, 'search'])->middleware(['auth'])->name('search.reports');
Route::post('/search-editor', [ReportController::class, 'searchEditor'])->middleware(['auth'])->name('search.editor');

// Ruta municipios
Route::get('/municipalities/{id}', [ReportController::class, 'municipalities'])->middleware(['auth'])->name('get.municipalities')->where('id', '[0-9]+');

// Rutas recursos multimedia

Route::get('/media', [ResourceController::class, 'getResources'] )->middleware(['auth'])->name('medias');
Route::get('get-resources/report/{id}', [ResourceController::class, 'getResourcesByReportId'])->middleware(['auth'])->name('get.resource')->where('id', '[0-9]+');
Route::post('/save-resource', [ResourceController::class, 'save'])->middleware(['auth'])->name('save.resource');
Route::get('/get-image/{filename}',  [ResourceController::class, 'getImage'])->middleware(['auth'])->name('getImage.resource');
Route::get('/download/{filename}',  [ResourceController::class, 'downloadFile'])->middleware(['auth'])->name('download.resource');
Route::post('/search-resources', [ResourceController::class, 'search'])->middleware(['auth'])->name('search.resources');
Route::get('/delete/{filename}',  [ResourceController::class, 'deleteFile'])->middleware(['auth'])->name('delete.resource');

// Rutas notas

Route::post('/save-note', [NoteController::class, 'save'])->middleware(['auth'])->name('save.note');
Route::get('/notes', [NoteController::class, 'notes'])->middleware(['auth'])->name('notes');
Route::get('/note-detail/{id}', [NoteController::class, 'detail'])->middleware(['auth'])->name('note.detail')->where('id', '[0-9]+');
Route::post('/search-notes', [NoteController::class, 'search'])->middleware(['auth'])->name('search.notes');


Route::get('/configurations', function () {
    return view('layouts.dashboard.config');
})->middleware(['auth'])->name('configurations');



require __DIR__.'/auth.php';
