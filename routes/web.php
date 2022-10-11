<?php

use App\Http\Controllers\VideoController;
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
    return view('video-list');
});

Route::get('refresh', function () {
    $json = 'https://services.brid.tv/services/mrss/latest/1/0/1/25/0.json';

    dispatch(new App\Jobs\RefreshVideoListJob($json, 'url'));
});

Route::get('video', [VideoController::class, 'getVideo'])->name('video');
