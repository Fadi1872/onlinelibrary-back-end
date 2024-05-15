<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show(string $id)
    {
        $book = Book::with('sub_category:id,name,category_id', 'sub_category.category:id,name')->find($id);
        if (!$book) return response()->json('book not found', 401);
        $book = new BookResource($book);
        return response()->json($book, 200);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|integer|exists:categories,id',
            'sub_category_id' => 'nullable|integer|exists:sub_categories,id'
        ]);

        $books = Book::query();

        $categoryId = $request->category_id;
        $subCategoryId = $request->sub_category_id;

        if($categoryId) {
            $books->whereHas('sub_category.category', function($query) use ($categoryId){
                $query->where('id', $categoryId);
            });
        }
        if($subCategoryId) {
            $books->whereHas('sub_category', function($query) use ($subCategoryId){
                $query->where('id', $subCategoryId);
            });
        }

        if(!$books) return response()->json('no books avaliable', 401);

        $books = BookResource::collection($books->get());
        return response()->json($books, 200);
    }
}
