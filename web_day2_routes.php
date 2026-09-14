<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;

Route::get('/tables', [TableController::class, 'index'])
    ->name('tables.index');

Route::get('/tables/{tableName}', [TableController::class, 'show'])
    ->name('tables.show');
