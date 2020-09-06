<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{

    public function books()
    {
        $books = Book::all();
        foreach ($books as $item){
            $item->category = $item->category->name;
        }
        $categories = Category::all();

        return [ 'books' => $books , 'categories' => $categories ];
    }


    public function choose(Request $request)
    {
        $cover = $request['filter']['cover'];
        $categories = $request['filter']['category'];
        $books = ($cover != 2) ? Book::where('paperback', $cover) : $books = Book::whereIn('paperback', [0,1]);
        if (isset($categories) && count($categories) > 0) {
            $books = $books->whereIn('category_id', $categories);
        }
        $books = $books->get();
        foreach ($books as $item){
            $item->category = $item->category->name;
        }

        return [
            'books' => $books,
            'cover' => $cover,
            'category' => $categories
        ];
    }
}
