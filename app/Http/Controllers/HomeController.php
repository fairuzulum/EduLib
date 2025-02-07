<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $newBooks = Book::orderBy('created_at', 'desc')->limit(4)->get();
        return view('index', compact('newBooks'));
    }

}
