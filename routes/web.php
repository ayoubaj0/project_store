<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/admin/commandes',[CommandeController::class,"index"])->name('admin.index')->middleware('auth');
//Route::post('/admin/change-etat',[CommandeController::class,"changeEtat"] )->name('admin.changeEtat');
Route::match(['post', 'put'], '/admin/change-etat', [CommandeController::class, 'changeEtat'])->name('admin.changeEtat')->middleware('auth');
//Route::get('/',function(){return test1;});

Route::get('/admin/export-csv', [CommandeController::class, 'exportCSV'])->name('admin.exportCSV')->middleware('auth');

Route::get('/',[HomeController::class,"index"])->name('home.index');
Route::get('/panier',[HomeController::class,"show_panier"])->name('home.panier');
Route::get('/panier/clear',[HomeController::class,"clear"])->name('home.clear');
Route::post('panier/add/{id}',[HomeController::class,"add"])->name('home.add');
Route::delete('panier/delete/{id}',[HomeController::class,"delete"])->name('home.delete');
Route::resource("categories",CategorieController::class)->middleware('auth');
Route::resource("clients",ClientController::class);
Route::resource("commandes",CommandeController::class);
Route::resource("produits",ProduitController::class);
use App\Http\Controllers\RoleController;

Route::resource('roles', RoleController::class);
use App\Http\Controllers\PermissionController;

Route::resource('permissions', PermissionController::class);

use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserRoleController;

Route::get('roles/{role}/assign-permissions', [RolePermissionController::class, 'index'])->name('roles.assign-permissions');
Route::post('roles/{role}/assign-permissions', [RolePermissionController::class, 'assign'])->name('roles.assign-permissions');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/user-roles', [UserRoleController::class, 'index'])->name('user.roles');
    Route::get('/user-roles/{user}/show-roles', [UserRoleController::class, 'showRoles'])->name('user.show-roles');
    Route::post('/user-roles/{user}/assign-roles', [UserRoleController::class, 'assignRoles'])->name('user.assign-roles');
});



require __DIR__.'/auth.php';
