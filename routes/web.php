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

use YouTube\Exception\YouTubeException;
use YouTube\YouTubeDownloader;

Route::get('/', function () {
    $youtube = new YouTubeDownloader();

    try {
        $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=akP0cRf7RO4");
        $item = collect($downloadOptions->getAudioFormats())->last();
        dd((new \App\Services\Downloader())->downloader($item));

    } catch (YouTubeException $e) {
        echo 'Something went wrong: ' . $e->getMessage();
    }
});
