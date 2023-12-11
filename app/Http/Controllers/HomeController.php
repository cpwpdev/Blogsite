<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
      public function home(){
        $posts =  Post::all();
        return view('home',['posts'=>$posts]);
      }
      public function about(){
        return view('about');
      }
      public function contact(){
        return view('contact');
      }
}
