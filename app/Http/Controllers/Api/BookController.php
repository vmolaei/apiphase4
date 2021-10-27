<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;

class BookController extends Controller
{
    //create method --Post
    public function createBook(Request $request){

        //validation
        $request->validate([
            "title"=>"required",
            "book_cost"=>"required"
        ]);
        //create data
        $book = new Book();
        $book->author_id = auth()->user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->book_cost = $request->book_cost;

        $book->save();

        //send response
        return response()->json([
            "status"=>true,
            "message"=>"Book created successfully"
        ]);


    }
    //list all books method --Get
    public function listBooks(){
        $books = Book::get();

        return response()->json([
           "status"=>true,
           "message"=>"all listed books",
           "data"=>$books
        ]);


    }
    //list specific author books  method--Get
    public function authorBooks(){
        $author_id = auth()->user()->id;
        $books = Author::find($author_id)->books;

        return response()->json([
            "status"=>true,
            "message"=>"all author books",
            "data"=>$books
        ]);


    }
    //single book method --Get
    public function singleBook($book_id){

    }
    //update method --Post
    public function updateBook(Request $request,$book_id){

    }
    //delete method --Get
    public function deleteBook($book_id){

    }

}
