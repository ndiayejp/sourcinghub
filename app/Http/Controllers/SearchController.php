<?php
namespace App\Http\Controllers;

use App\Open;
 
use App\Post;
use App\User;
use App\Category;
use Carbon\Carbon;
use App\CategoryPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 

class SearchController extends Controller
{

    protected $limit = 5;


    public function index(Request $request){
         
        $builder = Post::orderBy('id','desc')
                        ->Published()
                        ->inProgress('en-cours')
                        ->with('company');
              

        $keywords = $request->all();
        
        $term= $keywords['q'];

        $location = $keywords['location']; 

        if(!empty($term)){
            $builder->where(function ($query) use ($request) { 
                $query->whereHas('categories', function($query) use($request){ 
                    $query->where('categories.name','like','%'.$request->input('q').'%'); 
                })->orwhere(function($query) use($request){
                        $query->where('posts.name','LIKE','%'.$request->input('q').'%')
                              ->orwhere('posts.description','LIKE','%'.$request->input('q').'%');
                 });
             }); 
        }

        if(!empty($location)){
            
            $builder->whereHas('Country', function($query) use($request) {
                    $query->where('countries.name', 'like', '%'.$request->input('location').'%');
            });
        }

        $posts = $builder->paginate($this->limit); 

        $allcats = Category::with(['posts'=>function($q){
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('states.url_state','=','en-cours')
            ->where('posts.active',1) ;
            
        }])->get();

        $allopens = Open::with(['posts'=>function($q){
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('states.url_state','=','en-cours')
            ->where('posts.active',1) ;
            
        }])->get();
          
        return view('search.index',compact('posts','allcats','allopens')); 

        
    }
}