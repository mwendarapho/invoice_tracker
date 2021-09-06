<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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
    //return view('welcome');
    return redirect()->route('invoice.index');
})->name('scan');

Auth::routes();

Route::resource('invoice',InvoiceController::class);

Route::group(['middleware'=>'auth'],function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('staff',\App\Http\Controllers\StaffController::class);
Route::resource('state',\App\Http\Controllers\StateController::class);
Route::resource('customer',\App\Http\Controllers\CustomerController::class);
Route::get('import',[\App\Http\Controllers\CustomerController::class,'getImportFile'])->name('import.create');
Route::post('import',[\App\Http\Controllers\CustomerController::class,'import'])->name('import.store');

});
