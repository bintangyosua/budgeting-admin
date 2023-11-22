<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'category_types' => CategoryType::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_type_id' => 'required',
            'name' => 'required'
        ]);

        Category::create($validatedData);

        return redirect('/categories');
    }

    public function edit(Category $category, CategoryType $categoryType)
    {
        return view('categories.edit', [
            'category' => $category,
            'category_types' => $categoryType->all()
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'category_type_id' => 'required',
            'name' => 'required'
        ]);

        $category->update($validatedData);

        return redirect('/categories');
    }
}
