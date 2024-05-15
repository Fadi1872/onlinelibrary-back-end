<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function rateBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'rate' => 'required|numeric|between:0,5.0|regex:/^\d{0,1}(\.\d{1})?$/'
        ]);

        $user = User::find(auth()->id());
        $book = Book::find($request->book_id);
        $user->ratings()->attach($book->id, ['rate' => $request->rate]);

        $book = Book::with('ratings')->find($request->book_id);
        $total_rate = 0;
        foreach ($book->ratings as $user_rated) {
            $total_rate += $user_rated->pivot->rate;
        }

        $total_rate = $total_rate / count($book->ratings);
        $book->update([
            'total_rate' => $total_rate
        ]);

        return response()->json('book rated succesfully', 200);
    }

    public function addToFavorite(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id'
        ]);

        $user = User::find(auth()->id());
        $book = Book::find($request->book_id);
        $user->favorits()->attach($book->id);

        return response()->json('book added to favorite succesfully', 200);
    }

    public function getFavorits()
    {
        $user = User::find(auth()->id());
        $books = BookResource::collection($user->favorits);

        return response()->json($books);
    }
}
