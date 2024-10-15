<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// Route to view all items
Route::get('/', [OrderController::class, 'viewItems'])->name('items.index');

// Route to view all orders
Route::get('/orders', [OrderController::class, 'viewOrders'])->name('orders.index');

// Route to show the form to create an order
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

// Route to store a new order
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Route to edit an existing order
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

// Route to update an existing order
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

// Route to delete an order
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
