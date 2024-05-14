<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RiviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TestimoniController;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// auth

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('login_member', [AuthController::class, 'login_member']);
Route::post('login_member', [AuthController::class, 'login_member_action']);
Route::get('logout_member', [AuthController::class, 'logout_member']);

Route::get('register_member', [AuthController::class, 'register_member']);
Route::post('register_member', [AuthController::class, 'register_member_action']);

//Route Akses CRUD Admin

// CRUD kategori
Route::get('/kategori', [CategoryController::class, 'list']);

// CRUD sub_kategori
Route::get('/subkategori', [SubcategoryController::class, 'list']);

// CRUD slider
Route::get('/slider', [SliderController::class, 'list']);

// CRUD barang 
Route::get('/barang', [ProductController::class, 'list']);

// CRUD testimoni
Route::get('/testimoni', [TestimoniController::class, 'list']);

Route::get('/review', [RiviewController::class, 'list']);

Route::get('/payment', [PaymentController::class, 'list']);   



// Route Akses Pesanan Admin

Route::get('/pesanan/baru', [OrderController::class, 'pesanan_masuk'])->name('pesanan-masuk');
Route::get('/pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dikemas', [OrderController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim', [OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima', [OrderController::class, 'diterima_list']);
Route::get('/pesanan/selesai', [OrderController::class, 'selesai_list']);
Route::get('/pesanan/selesai', [OrderController::class, 'selesai_list']);


//Admin Akses

Route::get('/laporan', [ReportController::class, 'index']);

Route::get('/tentang', [TentangController::class, 'index']);
Route::post('/tentang/{about}', [TentangController::class, 'update']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/get-new-orders', [DashboardController::class, 'getNewOrders'])->name('getNewOrders');



//home routes
Route::get('/', [HomeController::class,'index']);
Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::get('/products/{subcategory}', [HomeController::class,'products']);
Route::get('/product/{id}', [HomeController::class,'product']);
Route::get('/cart', [HomeController::class,'cart']);
Route::get('/checkout', [HomeController::class,'checkout']);
Route::get('/orders', [HomeController::class,'orders']);
Route::get('/about', [HomeController::class,'about']);
Route::get('/contact', [HomeController::class,'contact']);
Route::get('/faq', [HomeController::class,'faq']);


Route::post('/add_to_cart', [HomeController::class,'add_to_cart']);
Route::get('/delete_from_cart/{cart}', [HomeController::class,'delete_from_cart']);
Route::get('/get_kota/{id}', [HomeController::class,'get_kota']);
Route::get('/get_ongkir/{destination}/{weight}', [HomeController::class,'get_ongkir']);
Route::post('/checkout_orders', [HomeController::class,'checkout_orders']);
Route::post('/payments', [HomeController::class, 'payments']);
Route::post('/pesanan_selesai/{order}', [HomeController::class, 'pesanan_selesai']);
Route::post('/pesanan_diterima/{order}', [HomeController::class, 'pesanan_diterima']);