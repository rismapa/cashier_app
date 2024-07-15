<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Illuminate\Routing\Router;

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

Route::get('/login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->middleware('admin');
    Route::get('/add-category', [CategoryController::class, 'add'])->middleware('admin');
    Route::post('/add-category', [CategoryController::class, 'store'])->middleware('admin');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->middleware('admin');
    Route::put('/edit-category/{id}', [CategoryController::class, 'update'])->middleware('admin');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->middleware('admin');

    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->middleware('admin');
    Route::get('/add-supplier', [SupplierController::class, 'add'])->middleware('admin');
    Route::post('/add-supplier', [SupplierController::class, 'store'])->middleware('admin');
    Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit'])->middleware('admin');
    Route::put('/edit-supplier/{id}', [SupplierController::class, 'update'])->middleware('admin');
    Route::delete('/delete-supplier/{id}', [SupplierController::class, 'destroy'])->middleware('admin');

    // User
    Route::get('/user', [UserController::class, 'index'])->middleware('admin');
    Route::get('/add-user', [UserController::class, 'add'])->middleware('admin');
    Route::post('/add-user', [UserController::class, 'store'])->middleware('admin');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->middleware('admin');
    Route::put('/edit-user/{id}', [UserController::class, 'update'])->middleware('admin');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->middleware('admin');

    // Barang
    Route::get('/product', [ProductController::class, 'index'])->middleware('admin');
    Route::get('/add-product', [ProductController::class, 'add'])->middleware('admin');
    Route::post('/add-product', [ProductController::class, 'store'])->middleware('admin');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->middleware('admin');
    Route::put('/edit-product/{id}', [ProductController::class, 'update'])->middleware('admin');

    // Stok Barang 
    Route::get('/stok', [ProductController::class, 'stok']);

    // Transaksi
    Route::get('/transaction', [TransactionController::class, 'index']);
    Route::get('/add-transaction', [TransactionController::class, 'store']);
    Route::get('/get-product/{id}', [TransactionController::class, 'getProduct'])->name('get.product');
    Route::post('/add-order', [TransactionController::class, 'addOrder'])->name('add.order');
    Route::get('/get-orders/{id}', [TransactionController::class, 'getDataOrder'])->name('get.orders');
    Route::get('/get-modal/{id}', [TransactionController::class, 'getModal'])->name('get.modal');
    Route::put('/update-transaction/{id}', [TransactionController::class, 'updateTransaction'])->name('update.transaction');
    Route::get('/transaction-detail/{id}', [TransactionController::class, 'show']);
    Route::get('/get-invoice/{id}', [TransactionController::class, 'getInvoice']);

    // Laporan Transaksi Penjualan
    Route::get('/laporan-penjualan', [ReportController::class, 'reportTransaction']);
    Route::get('/download-transaction', [ReportController::class, 'downloadTransaction']);

    // Profil
    Route::get('/profil', [UserController::class, 'profil']);
    Route::put('/edit-profil/{id}', [UserController::class, 'editProfil']);
});


