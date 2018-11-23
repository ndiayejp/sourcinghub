<?php
namespace App\Http\Controllers;

use App\User;
 
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class SettingsController extends Controller
{

    public function updateProfile(Guard $auth,Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $this->validate($request,[
            'name'=>"required|unique:users,email,{$user->id}|min:2",
            'email' => 'required|email',
            'avatar'=>'image'
        ]);
        
        $user->update($request->only('name','firstname','lastname','avatar'));
        Session::flash('success',"Votre compte a bien été modifié");
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Session::flash('success',__('Mot de passe mis à jour'));
                Auth::logout();
                return redirect()->back();
            } else {
                Session::flash('error','Les mots de passe ne correspondent pas');
                return redirect()->back();
            }
        } else {
            Session::flash('error',__('Les mots de passe ne correspondent pas'));
            return redirect()->back();
        }

    }
}

