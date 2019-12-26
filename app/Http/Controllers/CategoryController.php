<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function destroy(Request $request)
    {
        Category::truncate();
        foreach ($request->category as $value) {
            Category::query()->insert(['NAME' => strtoupper($value), 'TYPE' => 'SERVICES']);
        }
        $category = Category::all()->pluck('name');

        return ['success' => true, 'categories' => $category];
    }

    public function store(Request $request)
    {
        Category::query()->insert(['NAME' => strtoupper($request->category), 'TYPE' => 'SERVICES']);
        $category = Category::all()->pluck('name');

        return ['success' => true, 'categories' => $category];
    }
}
