<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResepController;
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

Route::controller(HomeController::class)->group(function(){
    Route::get('/','home')->name('home');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','authenticate')->name('authenticate');
    Route::post('/logout','logout')->name('logout');
    Route::get('/register','register')->name('register');
    Route::post('/register','register_new')->name('register_new');
});

Route::controller(ResepController::class)->group(function(){
    Route::get('/reseps/add','create')->name('reseps.create')->middleware('auth');
    Route::post('/reseps/store','store')->name('reseps.store');
    Route::get('/reseps/{resep}/show','show')->name('reseps.show');
    Route::get('/reseps/{resep}/edit','edit')->name('reseps.edit');
    Route::post('/reseps/{resep}/update','update')->name('reseps.update');
    Route::post('/reseps/{resep}/delete','delete')->name('reseps.delete');
    Route::post('/reseps/{resep}/{resep_photo}/delete_photo','delete_photo')->name('reseps.delete_photo');
    Route::post('/reseps/{resep}/add_photo','add_photo')->name('reseps.add_photo');
});

Route::controller(BahanController::class)->group(function(){
    Route::get('/bahans/add','create')->name('bahans.create')->middleware('auth');
    Route::post('/bahans/store','store')->name('bahans.store');
    Route::get('/bahans/{bahan}/show','show')->name('bahans.show');
    Route::get('/bahans/{bahan}/edit','edit')->name('bahans.edit');
    Route::post('/bahans/{bahan}/update','update')->name('bahans.update');
    Route::post('/bahans/{bahan}/delete','delete')->name('bahans.delete');
    Route::post('/bahans/{bahan}/{bahan_photo}/delete_photo','delete_photo')->name('bahans.delete_photo');
    Route::post('/bahans/{bahan}/add_photo','add_photo')->name('bahans.add_photo');
});

Route::controller(CalculatorController::class)->group(function(){
    Route::get('/calculator/index','index')->name('calculator.index')->middleware('auth');
});

// Route::controller(UserController::class)->group(function(){
//     Route::get('/users/{user}/list_of_items','list_of_items')->name('users.list_of_items')->middleware('auth');
// });

// Route::controller(CartController::class)->group(function(){
//     Route::get('/carts/{user}/index','index')->name('carts.index')->middleware('auth');
//     Route::get('/carts/{from}/pilih_tipe_barang','pilih_tipe_barang')->name('carts.pilih_tipe_barang')->middleware('auth');
//     Route::get('/carts/{from}/{tipe_barang}/create_item','create_item')->name('carts.create_item')->middleware('auth');
// });

// Route::controller(ArtisanController::class)->group(function(){
//     Route::get('/artisans','index')->name('artisans.index')->middleware('auth');
//     Route::post('/artisans/migrate_fresh_seed','migrate_fresh_seed')->name('artisans.migrate_fresh_seed')->middleware('auth');
//     Route::post('/artisans/symbolic_link','symbolic_link')->name('artisans.symbolic_link')->middleware('auth');
//     Route::post('/artisans/optimize_clear','optimize_clear')->name('artisans.optimize_clear')->middleware('auth');
//     // Route::post('/artisans/vendor_publish_laravelPWA','vendor_publish_laravelPWA')->name('artisans.vendor_publish_laravelPWA')->middleware('auth');
// });
