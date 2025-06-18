<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Ruta para la vista de reportes en admin
Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');

Route::get('/admin/reportes/pdf', [AdminController::class, 'reportePdf'])->name('admin.reportes.pdf');
