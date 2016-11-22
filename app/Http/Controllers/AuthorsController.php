<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Author;
use App\Book;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        $response = [
            'count' => count($authors),
            'list' => $authors
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
        $authorName = $request->input('author_name', Null);

        if (empty($authorName)) {
            return response('', 400);
        }

        $author = new Author();
        $author->author_name = $authorName;
        $author->save();

        return response('', 201)
            ->header('Location', '/authors/' . $author->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);

        if ($author == Null) {
            return response('', 404);
        }

        $author['books_count'] = Book::where('author_id', $id)->count();
        return response()->json($author, 200);
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
        $author = Author::find($id);

        If ($author == Null) {
            return response('', 404);
        }

        $authorName = $request->input('author_name', Null);

        if (!empty($authorName)) {
            $author->author_name = $authorName;
        }

        $author->save();
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
        $author = Author::find($id);

        if ($author == Null) {
            return response('', 404);
        }

        $author->delete();
        return response('', 200);
    }
}
