<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens; // Add this line

class Author extends Model
{

    use HasFactory, HasApiTokens;  // Add this HasApiTokens;

    public $timestamps =false;

    protected $table = "authors";
    protected $fillable = ["name","email","password","phone_no"];
}
