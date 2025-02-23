<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FoodsController;


Route::get('/', function () {
    return view('home');
});


// Hiển thị danh sách sản phẩm
Route::get('products', [
    ProductsController::class,
    'index'
]);

// Hiển thị danh sách món ăn
Route::get('/foods', [FoodsController::class, 'index'])->name('foods.index');

// Hiển thị form chỉnh sửa món ăn theo ID
Route::get('/foods/edit/{id}', [FoodsController::class, 'edit'])->name('foods.edit');

// Xóa món ăn theo ID
Route::get('/foods/delete/{id}', [FoodsController::class, 'delete'])->name('foods.delete');

// Hiển thị form tạo món ăn mới
Route::get('/foods/create', [FoodsController::class, 'create'])->name('foods.create');

// Lưu món ăn mới vào database
Route::post('/foods', [FoodsController::class, 'store'])->name('foods.store');

// Cập nhật thông tin món ăn theo ID
Route::put('/foods/{id}', [FoodsController::class, 'update'])->name('foods.update');





