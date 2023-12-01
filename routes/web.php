<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,"index"])->name('home.index');
Route::get('/panier',[HomeController::class,"show_panier"])->name('home.panier');
Route::get('/panier/clear',[HomeController::class,"clear"])->name('home.clear');
Route::post('panier/add/{id}',[HomeController::class,"add"])->name('home.add');
Route::delete('panier/delete/{id}',[HomeController::class,"delete"])->name('home.delete');
Route::resource("categories",CategorieController::class);