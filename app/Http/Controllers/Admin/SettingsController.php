<?php
namespace App\Http\Controllers\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    
    
    private $auth; 

    public function __construct(Guard $auth){
        $this->middleware('auth');
        $this->auth = $auth;
    }
    
    public function index()
    {
        return view('admin.settings');
    }
    public function updateProfile(Request $request)
    {
        $user = $this->auth->user();
        $this->validate($request,[
            'name'=>"required|unique:users,email,{$user->id}|min:2",
            'avatar'=>'image'
        ]);
          
        $user->update($request->only('name','firstname','lastname','avatar'));

        Flashy::success(__("Profil bien mis à jour :)"));
        return redirect()->back();
    }
    public function updatePassword(Request $request)
    {
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
                Flashy::success(__("Mot de passe changé avec succés"));
                Auth::logout();
                return redirect()->back();
            } else {
                Flashy::error(__("Le nouveau mot de passe ne peut pas être identique à l'ancien"));
                return redirect()->back();
            }
        } else {
            Flashy::error(__("Les mots de passe ne correspondent pas"));
            return redirect()->back();
        }
    }
}