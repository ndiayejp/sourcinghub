<?php

namespace App\Http\Controllers;

use App\Post;
use App\Company;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    /**
     * intence de class
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {  
        $this->middleware('auth', ['except' => ['index','home','about','cgu']]);
        $this->auth = $auth;
    }

    /**
     * Page daccueil
     *
     * @return void
     */
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
         ->inProgress('en-cours')
         ->with('country')
         ->with('Company')
         ->limit(3)
         ->get();

        $featuredProviders = User::where('featured', 1)
            ->with('Profile')
            ->limit(6)
            ->get();
        //dd($featuredProviders);
        return view('pages.home',compact('posts','companies','nbPosts', 'featuredProviders'));

        
         
     }
    
    /**
     *  Page a propos  
     *
     * @return void
     */
    public function about(){
        return view('pages.about');
    }

    /**
     *  Page cgu
     *
     * @return void
     */
    public function cgu(){
        return view('pages.cgu');
    }
    
}
