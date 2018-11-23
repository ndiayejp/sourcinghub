<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use App\Profile;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 
class DashboardController extends Controller
{
    //

    public function index(){
        $posts = Post::all();

        $popular_posts = Post::withCount('favorite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
         
        $total_pending_posts = Post::where('active',true)->count();

        $all_views = Post::sum('view_count');

        $author_count = User::all()->count();

        $new_authors_today = User::where('role_id','!=',2)
                                ->whereDate('created_at',Carbon::today())->count();

       $active_authors = User::withCount('posts')
                                ->withCount('favorite_posts')
                                ->whereNotIn('role_id', [2])
                                ->where('active', '=', 1)
                                 ->join('profiles', function ($join) {
                                    $join->on('users.id', '=', 'profiles.user_id')
                                         ->where('profiles.type','!=','fournisseur');
                                })
                                ->orderBy('posts_count','desc')
                                ->orderBy('favorite_posts_count','desc')
                                ->take(10)->get();

       $category_count = Category::all()->count();
       return view('admin.dashboard',compact('posts','total_pending_posts',
        'all_views','category_count','author_count','new_authors_today','active_authors','popular_posts'));
    }
}
