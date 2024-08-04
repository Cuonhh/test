<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
});

$cruds = [
    'categories' => CategoryController::class,
    'orders' => OrderController::class,
];

foreach ($cruds as $obj => $controller) {
    Route::resource($obj, $controller);
}
