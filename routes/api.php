<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formSubmit;


Route::controller(formSubmit::class)->group(function() {
    Route::post('/submit', 'create')->name('form.submit');
    Route::get('/sibling/{childId}', 'getSibling')->name('sibling.get');
    Route::get('/child/{childId}', 'getChildById')->name('child.get');
    Route::get('/parents/{childId}', 'getParents')->name('parent.get');
    Route::get('/childs/{parentId}', 'getAllChilds')->name('childs.get');
});


