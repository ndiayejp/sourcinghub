<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Company;
use App\Country;
use App\Profile;
use App\Rating;
use App\Activity;
use App\Category;
use App\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    private $auth; 
    protected $limit = 4;
    public function __construct(Guard $auth){
        $this->middleware('auth');
        $this->auth = $auth;
    }

    public function account($username){
        if(!Auth::user()){
            Session::flash('error',__("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }
        Carbon::setLocale(config('app.locale'));
        $countries = Country::all();
        $categories = Category::all();
        $activities = Activity::all();
        $user = User::where('name',$username)->first();
        return view('users.account',compact('user','activities','categories','countries'));
    }

     /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request){ 
        $profil = Profile::with(['user'])->findOrFail(Auth::user()->id);
        // Get validation rules
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users',
            'password'=> 'required|string|min:6|confirmed'
        ]);
       
        $user = User::create([
            'name'              => $request['name'],
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
            'role_id'           => '5',
            'confirmation_token'=> str_replace('/','',bcrypt(str_random(16))),
        ]);
        $company = new Company([
            'name' => $profil['company'],
            'phone'=> $profil['phone'],
            'address' => $profil['address'],
            'description'=>'',
            'email' => $request['email'],
            'user_id' => $user->id
        ]);
        
        $user->companies()->save($company);
        $profile = new Profile([
            'type'=>$profil['type'],
            'company'=>$profil['company'],
            'phone'=>$request['phone'],
            'address'=>$profil['address'],
            'siret'=>$profil['siret']
        ]);
        $user->profile()->save($profile);
        if( $user){
            $user->notify(new RegisteredUser());
            Session::flash('success', __("compte bien créé, à  confirmer par mail"));
            return redirect()->back(); 
        }
    }

    public function getProviders(Request $request){
        $users = User::join('assigns', function ($join) {
                        $join->on('users.id', '=', 'assigns.provider_id')
                              ->where('assigns.buyer_id', '=', Auth::id());
                            })
                        ->join('profiles',function($q){
                           $q->on('profiles.user_id','=','users.id');
                        })
                         ->paginate($this->limit);

   
         
        return view('users.providers',compact('users','rating'));
    }


  
    public function getCustomers(){ 
        $users = User::join('assigns', function ($join) {
            $join->on('users.id', '=', 'assigns.buyer_id')
                 ->where('assigns.provider_id', '=', Auth::id());
        })->join('profiles',function($q){
            $q->on('profiles.user_id','=','users.id');
        })->paginate($this->limit);
        return view('users.customers',compact('users'));
    }

    public function getArchived(){
        $posts = Post::join('assigns', function ($join) {
            $join->on('posts.id', '=', 'assigns.post_id')
                ->where('assigns.provider_id', '=', Auth::id());
        })->paginate($this->limit);
        return view('users.archives',compact('posts'));
    }
}