<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class FavoriteController extends Controller
{
    /**
     * sauvegarder un post en favoris
     *
     * @param [type] $post
     * @return void
     */
    public function add($post)
    { 
        $user = Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id',$post)->count();
         
        if ($isFavorite == 0)
        {
            $user->favorite_posts()->attach($post);
            Session::flash('success',__('Offre ajoutée avec succès à votre liste de favoris :)'));
            return redirect()->back();
        } else {
            $user->favorite_posts()->detach($post);
            Session::flash('warning',__('Offre supprimée avec succès de votre liste de favoris :)'));
            return redirect()->back();
        }
    }
}