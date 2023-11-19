<?php

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
    return view('singlePage');
});
Route::get('/list', [\App\Http\Controllers\SinglePageController::class, 'index'])->name('list');
Route::post('/add-user', [\App\Http\Controllers\SinglePageController::class, 'addUser'])->name('adduser');
Route::get('/list-data', [\App\Http\Controllers\SinglePageController::class, 'listData'])->name('listdata');
