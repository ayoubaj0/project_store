<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;


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
Route::get('/admin/commandes',[CommandeController::class,"index"])->name('admin.index');
//Route::post('/admin/change-etat',[CommandeController::class,"changeEtat"] )->name('admin.changeEtat');
Route::match(['post', 'put'], '/admin/change-etat', [CommandeController::class, 'changeEtat'])->name('admin.changeEtat');
//Route::get('/',function(){return test1;});

Route::get('/admin/export-csv', [CommandeController::class, 'exportCSV'])->name('admin.exportCSV');

Route::get('/',[HomeController::class,"index"])->name('home.index');
Route::get('/panier',[HomeController::class,"show_panier"])->name('home.panier');
Route::get('/panier/clear',[HomeController::class,"clear"])->name('home.clear');
Route::post('panier/add/{id}',[HomeController::class,"add"])->name('home.add');
Route::delete('panier/delete/{id}',[HomeController::class,"delete"])->name('home.delete');
Route::resource("categories",CategorieController::class);
Route::resource("clients",ClientController::class);
Route::resource("commandes",CommandeController::class);
