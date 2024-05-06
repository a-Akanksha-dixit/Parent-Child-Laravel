<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class Category extends Controller
{
    public function index()
    {
        $categories = Categories::where('parent_id', null)->with('subcategories')->get();
        return view('category', ['parentCategories' => $categories]);
    }

    public function getCategoriesByParentId($parentId)
    {
        $categories = Categories::where('parent_id', $parentId)->get();
        return response()->json($categories);
    }
}