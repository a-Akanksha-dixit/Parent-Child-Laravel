<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category;

Route::get('/', function () {
    return view('form');
});
Route::controller(Category::class)->group(function() {
   
    Route::get('/category',  'index')->name('category.page');
});


