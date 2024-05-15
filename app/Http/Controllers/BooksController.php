<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;
use function Ramsey\Uuid\v1;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('sub_category:id,name,category_id', 'sub_category.category:id,name')
            ->select('id', 'name', 'total_rate', 'created_at', 'updated_at', 'sub_category_id')
            ->get();

        return view('books.show', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_book(string $category)
    {
        if ($category == -1) {
            $first_categories = Category::select('id', 'name')->first();
            if (!$first_categories) return redirect()->route('categories.create');
            $category = $first_categories->id;
        }
        $categories = Category::all()->select('id', 'name');
        if ($categories->isEmpty()) return redirect()->route('categories.create');

        $sub_categories = SubCategory::where('category_id', $category)->select('id', 'name', 'category_id')->get();
        if ($sub_categories->isEmpty()) return redirect()->route('subcategories.create');

        return view('books.form', compact('categories', 'sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id'
        ]);

        Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'sub_category_id' => $request->sub_category_id
        ]);

        return redirect()->route('books.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_book(string $category, string $id)
    {
        $sub_categories = SubCategory::where('category_id', $category)->select('id', 'name', 'category_id')->get();
        $categories = Category::all()->select('id', 'name', 'catygory_id');
        $book = Book::with('sub_category:id,category_id')
            ->where('id', $id)
            ->select('id', 'name', 'description', 'sub_category_id')
            ->get();
        // return $book;

        return view('books.form', compact('book', 'sub_categories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id'
        ]);

        Book::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'sub_category_id' => $request->sub_category_id
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('id', $id)->delete();

        return redirect()->route('books.index');
    }
}
