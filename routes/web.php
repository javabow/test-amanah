<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\backend\dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\event\EventController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Auth;

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

    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } else if (Auth::guard('client')->check()) {
        return redirect()->route('client.dashboard');
    }
    return view('welcome');
});


// Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Route::get('/event', [EventController::class, 'index'])->name('event.table');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/python', [EventController::class, 'testPython'])->name('python');

// view login
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('register.admin');
Route::get('/register', [RegisterController::class, 'showClientRegisterForm'])->name('register.client');

// login function
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/client', [RegisterController::class, 'createClient']);

// logout
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    // dashboard
    Route::resource('dashboard', DashboardController::class);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //event
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.table');
});

// client
Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'auth:client'], function () {
    // dashboard
    Route::view('/', 'client')->name('dashboard');
});
