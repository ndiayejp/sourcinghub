<?php

namespace App\Http\Controllers;

use App\Assign;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssignController extends Controller
{
    //

    public function store(Request $request){

        $post = Post::findOrFail($request->postID);

         
        $assign = new Assign();
        $assign->post_id = $request->postID;
        $assign->buyer_id = $request->buyer;
        $assign->provider_id = $request->provider;
        $assign->save();

        $post->update(['state_id'=>3]);


        Session::flash('success',__("Offre bien attribuée"));
        return redirect()->back();
    }
}
