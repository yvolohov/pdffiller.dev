<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;

class AuthorsBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $books = Book::where('author_id', $id)->get();
        $response = [
            'count' => count($books),
            'list' => $books
        ];

        return response()->json($response, 200);
    }
}
