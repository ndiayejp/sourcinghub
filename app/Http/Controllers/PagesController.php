<?php

namespace App\Http\Controllers;

use App\Post;
use App\Company;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
 
    public function __construct(Guard $auth)
    {

        
        $this->middleware('auth', ['except' => ['index','home','about','cgu']]);
        $this->auth = $auth;
    }

    public function home(){
       
        Carbon::setLocale(config('app.locale'));
        //$categories = Category::all();
        $companies = Company::all();

        $nbPosts = Post::orderBy('id','desc')
         ->Published()
         ->inProgress('en-cours')
         ->get();

        $posts = Post::orderBy('id','desc')
         ->Published()
         ->with('country')
         ->with('Company')
         ->limit(3)
         ->get();
         return view('pages.home',compact('posts','companies','nbPosts'));

         
     }

    public function about(){
        return view('pages.about');
    }

    public function cgu(){
        return view('pages.cgu');
    }
    
}
