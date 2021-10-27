<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

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
    //list method --Get
    public function listBooks(){


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
