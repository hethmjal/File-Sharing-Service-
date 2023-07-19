<?php

use App\Http\Controllers\SharedFileController;
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
})->name('home');

Route::post('/upload',[SharedFileController::class,'store'])->name('upload');

Route::get('/success/{id}',[SharedFileController::class,'success'])->name('success');


Route::get('/download-page/{id}',[SharedFileController::class,'download_page'])->name('download_page');
Route::get('/download/{id}',[SharedFileController::class,'download'])->name('download');

Route::get('/{code}',[SharedFileController::class,'short_link'])->name('short-link');