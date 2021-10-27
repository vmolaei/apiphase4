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
        //validation
        $author_data = $request->validate([
            "email"=>"required",
            "password"=>"required"
        ]);

        //validate author data
        if(!auth()->attempt($author_data)){
            return response()->json([
                "status"=>false,
                "message" => "invalid credentionals"
            ]);
        }
        //token
        $token = auth()->user()->createToken("auth_token")->accessToken;

        //send response
        return response()->json([
            "status"=>true,
            "message"=>"author login successfully",
            "access_token"=> $token
        ]);

    }
    //profile Api --Get
    public function profile(){
        $user_data = auth()->user();

        return response()->json([
            "status"=>true,
            "message"=>"user data",
            "data"=>$user_data
        ]);

    }
    //log out Api --Post
    public function logout(Request $request){
        //get token value
        $token = $request->user()->token();

        //revoke this token value
        $token->revoke();

        return response()->json([
            "status"=>true,
            "message"=>"Author deleted successfully"
        ]);


    }

}
