<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //Register Api --Post
    public function register(Request $request){
        //validation
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:authors",
            "password"=>"required|confirmed",
            "phone_no"=>"required"
        ]);
        //create data and save it
        $author = new Author();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = bcrypt($request->password);
        $author->phone_no = $request->phone_no;

        $author->save();

        //response
        return response()->json([
            "status"=>1,
            "message"=>"Author registered successfully"
        ]);


    }
    //login Api --Post
    public function login(Request $request){

    }
    //profile Api --Get
    public function profile(){

    }
    //log out Api --Get
    public function logout(){

    }

}
