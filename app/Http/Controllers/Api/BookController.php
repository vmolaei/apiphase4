<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use http\Env\Response;
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
        $author_id = auth()->user()->id;
        if(Book::where([
           "author_id"=>$author_id,
            "id"=>$book_id
        ])->exists()){
            $book = Book::find($book_id);
            return response()->json([
                "status"=>true,
                "message"=>"book data found",
                "data"=>$book
            ]);

        }else{
            return response()->json([
               "status"=>false,
               "message"=>"Author book doesn't exists"
            ]);
        }


    }
    //update method --Post
    public function updateBook(Request $request,$book_id){
        $author_id = auth()->user()->id;
        if(Book::where([
            "author_id"=>$author_id,
            "id"=>$book_id
        ])->exists()){
            $book = Book::find($book_id);
            $book->title = isset($request->title)?$request->title : $book->title;
            $book->description = isset($request->description)?$request->description : $book->description;
            $book->book_cost = isset($request->book_cost)?$request->book_cost : $book->book_cost;

            $book->save();

            return response()->json([
                "status"=>true,
                "message"=>"book data has been updated"
            ]);

        }else{
            return response()->json([
                "status"=>false,
                "message"=>"Author book doesn't exists"
            ]);
        }

    }
    //delete method --Get
    public function deleteBook($book_id){
        $author_id = auth()->user()->id;
        if(Book::where([
            "author_id"=>$author_id,
            "id"=>$book_id
        ])->exists()) {
            $book = Book::find($book_id);
            $book->delete();
            return \response()->json([
                "status"=>true,
                "message"=>"book has been deleted"
            ]);

        }else{
            return response()->json([
                "status"=>false,
                "message"=>"Author book doesn't exists"
            ]);
        }

    }

}
