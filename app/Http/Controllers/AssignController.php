<?php

namespace App\Http\Controllers;

use App\Assign;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Notifications\AssignPost;
use Illuminate\Support\Facades\Notification;

class AssignController extends Controller
{
    //

    public function store(Request $request){

        $post = Post::findOrFail($request->postID);
        $user = User::findOrFail($request->provider);
         
        $assign = new Assign();
        $assign->post_id = $request->postID;
        $assign->buyer_id = $request->buyer;
        $assign->provider_id = $request->provider;
        $assign->save();

        $post->update(['state_id'=>3,'active'=>0]);

        Notification::send($user, new AssignPost($post));

        Session::flash('success',__("Offre bien attribuée"));
        return redirect()->back();
    }
}
