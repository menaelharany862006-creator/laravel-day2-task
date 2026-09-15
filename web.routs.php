<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;

// ===== TASK 2 ROUTES (Original) =====
Route::get('/tables', [TableController::class, 'index'])
    ->name('tables.index');

Route::get('/tables/{tableName}', [TableController::class, 'show'])
    ->name('tables.show');

// ===== TASK 3 NEW ROUTES - Full CRUD =====

// Create new record in table
Route::get('/tables/{tableName}/create', [TableController::class, 'create'])
    ->name('tables.create');

// Store new record
Route::post('/tables/{tableName}', [TableController::class, 'store'])
    ->name('tables.store');
