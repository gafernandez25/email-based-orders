<?php

use App\Http\Controllers\OrderController;
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

Route::controller(OrderController::class)->group(function () {
    Route::get("/order", "index")->name("order.index");
    Route::get("/order/datatable", "indexDatatable")->name("order.indexDatatable");
    Route::get("/order/{id}", "show")->name("order.show")->where(["id" => "[0-9]+"]);
    Route::get("/order/{id}/reply", "reply")->name("order.reply")->where(["id" => "[0-9]+"]);
});
