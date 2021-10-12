<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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

Route::get('/unit', [CompanyController::class,'view_unit'])->name('view');
Route::get('/search_unit', [CompanyController::class,'search_unit_by_key']);
Route::get('/unitById/{id}', [CompanyController::class,'show'])->name('show');
