<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        return view('books.catalog', compact('books'));
    }

   
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->reviews()->with('user')->latest()->paginate(5); // Assuming you want to paginate reviews
    
        return view('books.show', compact('book', 'reviews'));
    }
    
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|integer|between:1,5'
        ]);
    
        $book = Book::findOrFail($id);
    
        Review::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);
    
        return back()->with('success', 'Review added successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->paginate(10);

        return view('books.catalog', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publisher' => 'required|max:255',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }

        Book::create($validatedData);

        return redirect()->route('book.catalog')->with('success', 'Book created successfully!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publisher' => 'required|max:255',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }
            $validatedData['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }

        $book->update($validatedData);


        return redirect()->route('book.show', ['id' => $book->id])->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);


        if ($book->cover_image) {
            Storage::delete('public/' . $book->cover_image);
        }

        $book->delete();

        return redirect()->route('book.catalog')->with('success', 'Book deleted successfully!');
    }
}
