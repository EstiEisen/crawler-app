<?php

use App\Http\Controllers\CrawlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('crawler')->group(function () {
    Route::post('/',[ CrawlController::class, 'crawl']);
});
// Route::post('crawl', 'App\Http\Controllers\CrawlerController@crawl');