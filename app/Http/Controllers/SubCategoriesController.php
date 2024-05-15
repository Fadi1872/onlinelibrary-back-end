<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = SubCategory::with('category')->get();

        return view('subcategories.show', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->select('id', 'name');
        if ($categories->isEmpty()) return redirect()->route('categories.create');

        return view('subcategories.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:sub_categories',
            'category' => 'required|exists:categories,id'
        ]);

        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category
        ]);

        return redirect()->route('subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = SubCategory::where('id', $id)->select('id', 'name', 'category_id')->get();
        $categories = Category::all()->select('id', 'name');

        return view('subcategories.form', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20', Rule::unique('sub_categories')->ignore($id) ],
            'category' => 'required|exists:categories,id'
        ]);

        SubCategory::where('id', $id)->update([
            'name' => $request->name,
            'category_id' => $request->category
        ]);

        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::where('id', $id)->delete();

        return redirect()->route('subcategories.index');
    }
}
