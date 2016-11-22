<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use App\Author;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $response = [
            'count' => count($books),
            'list' => $books
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookName = $request->input('book_name', Null);
        $authorId = $request->input('author_id', Null);

        if (empty($bookName) || empty($authorId) || !(Author::find($authorId))) {
            return response('', 400);
        }

        $book = new Book();
        $book->book_name = $bookName;
        $book->author_id = $authorId;
        $book->save();

        return response('', 201)
            ->header('Location', '/books/' . $book->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if ($book == Null) {
            return response('', 404);
        }

        $author = Author::find($book['author_id']);
        $book['author_name'] = $author['author_name'];

        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        If ($book == Null) {
            return response('', 404);
        }

        $bookName = $request->input('book_name', Null);
        $authorId = $request->input('author_id', Null);

        if (!empty($bookName)) {
            $book->book_name = $bookName;
        }

        if (!empty($authorId) && Author::find($authorId)) {
            $book->author_id = $authorId;
        }

        $book->save();
        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book == Null) {
            return response('', 404);
        }

        $book->delete();
        return response('', 200);
    }
}
