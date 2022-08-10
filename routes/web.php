<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;

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

/*Route::get('/', function () {
    return view('customer');
});
*/

Route::get('/customer',[CustomerController::class,'index']);
Route::get('/add-customer',[CustomerController::class,'add']);
Route::post('/add-customer',[CustomerController::class,'stored']);
Route::get('/delete-customer/{id}',[CustomerController::class,'drop']);
Route::get('/edit-customer/{id}',[CustomerController::class,'source']);
Route::post('/update-customer',[CustomerController::class,'update']);


Route::get('/invoice',[InvoiceController::class,'index']);
Route::get('/add-invoice',[InvoiceController::class,'add']);
Route::post('/add-invoice',[InvoiceController::class,'inject']);
Route::get('/delete-invoice/{id}',[InvoiceController::class,'delete']);
Route::get('/detail/{id}',[InvoiceController::class,'detail']);
Route::get('/edit-invoice/{id}',[InvoiceController::class,'get_edit_data']);
Route::post('/update-invoice',[InvoiceController::class,'updating_data']);
