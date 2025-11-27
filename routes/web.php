<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('students', StudentController::class);

Route::resource('fee_types', FeeTypeController::class);
Route::get('students/{student}/fees', [InvoiceController::class, 'getClassFees']);

Route::get('/students/view/{id}', [StudentController::class, 'view'])->name('students.view');

// Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
// Route::get('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
// Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::resource('invoices', InvoiceController::class);

Route::get('invoices/{invoice}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('payments.store');
