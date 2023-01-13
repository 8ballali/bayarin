<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

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

Route::GET('/', [HomeController::class, 'home']);

Route::GET('/login',[AuthController::class,'index']);
Route::POST('/login',[AuthController::class,'login'])->name('login');
Route::GET('/register', [AuthController::class,'regist']);
Route::POST('/register', [AuthController::class,'register'])->name('register');
Route::GET('/logout', [AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['Admin']], function (){
    Route::GET('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::GET('/university', [DashboardController::class, 'university'])->name('university');
    Route::GET('/roles', [DashboardController::class, 'roles'])->name('roles');
    Route::GET('/merchant', [DashboardController::class, 'merchant'])->name('merchant');
    Route::POST('/merchant/add', [DashboardController::class, 'add_merchant'])->name('merchant-add');
    Route::GET('/merchant/add', [DashboardController::class, 'merchant_add']);
    Route::GET('/merchant/edit/{id}', [DashboardController::class, 'edit_merchant']);
    Route::PUT('/merchant/update/{id}', [DashboardController::class, 'update_merchant'])->name('update-merchant');
    Route::GET('/merchant/delete/{id}', [DashboardController::class, 'delete_merchant'])->name('delete-merchant');
    Route::POST('/university', [DashboardController::class, 'import_excel'])->name('import-university');
});
