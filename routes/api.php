<?php

use App\Http\Controllers\Auth\LoginJwtController;
use App\Http\Controllers\InventoryController;
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

Route::get('inventory-list', [InventoryController::class, 'show'])->name('inventory_table'); //get all data event
Route::post('inventory-data-id', [InventoryController::class, 'getDataId'])->name('inventory_data_id'); //post to get edit data
Route::post('inventory-store', [InventoryController::class, 'store'])->name('inventory_store'); //get all data event
Route::post('inventory-update', [InventoryController::class, 'update'])->name('inventory_update');
Route::post('inventory-delete', [InventoryController::class, 'destroy'])->name('inventory_delete');

Route::post('secret-check', [InventoryController::class, 'secretNumber'])->name('secret_check');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [LoginJwtController::class, 'login']);
Route::post('register', [LoginJwtController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [LoginJwtController::class, 'logout']);
    Route::post('get_user', [LoginJwtController::class, 'get_user']);
    Route::post('refresh_token', [LoginJwtController::class, 'refresh']);
});
