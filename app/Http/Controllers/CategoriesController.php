<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Categories::create([
            'name' => $request->name,
        ]);

        return response()->json(['category' => $category], 201);
    }
}
