<?php

namespace App\Http\Controllers;

use App\Post;
use App\Company;
use App\Category;
use App\User;
use App\Banner;
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
         ->with('state')
         ->where('state_id',1)
         ->where('active',1)
         ->get();
       

        $featuredProviders = User::where('featured', 1)
            ->with('Profile')
            ->limit(6)
            ->get();
        
        $banners = Banner::Published()
        ->IsValid(Carbon::now()->format('Y-m-d'))
        ->get();
         
        return view('pages.home',compact('posts','companies','nbPosts', 'featuredProviders', 'banners'));

        
         
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
