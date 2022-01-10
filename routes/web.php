<?php

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

Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/mp4', function () {
    return view('mp4');
})->name('mp4');
Route::get('/converter', function () {
    return view('ytube-converter');
})->name('converter');
Route::get('/downloader', function () {
    return view('ytube-download');
})->name('downloader');
Route::get('/convert', function () {
    return view('convert');
})->name('convert');


Route::get('/',[\App\Http\Controllers\YoutubeController::class,'search']);
