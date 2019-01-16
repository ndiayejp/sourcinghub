<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\Country;
use App\Profile;
use App\Activity;
use App\Category;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    /*
    | Register Controller
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    */

    use \Illuminate\Foundation\Auth\RegistersUsers;

    /**
    * Where to redirect users after registration.
    * @var string
    */
    protected $redirectTo = '/';

    /**
    * Create a new controller instance.
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $countries  = Country::pluck('name','id'); 
        $categories = Category::pluck('name', 'id'); 
        $activities = Activity::pluck('name','id'); 
        return view('auth.register', compact('countries','categories','activities'));
    }

     /**
     * Get a validator for an incoming registration request.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'siret'      => 'required',
            'firmsize'   => 'required',
            'company'    => 'required',
            'phone'      => 'required',
            'address'    => 'required',
            'country_id' => 'required',
            'category_id'=> 'required',
            'activity_id'=> 'required'
         ]);
    }

    public function register(Request $request)
    { 
         if( $request->term == 1){ 
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all()))); 
            $user->notify(new RegisteredUser());
            Session::flash('success', __("votre compte a bien été crée, vous devez le confirmez par mail"));
             return redirect()->route('login');   
        }else{
            Flashy::error("Vous devez accepter les Termes et Conditions d'utilisation");
            return redirect()->route('register'); 
        } 
    }

    
    /**
    * Create a new user instance after a valid registration.
    * @param  array  $data
    * @return \App\User
    */
    protected function create(array  $data)
    {  
        $user = User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role_id'           => '5',
            'confirmation_token'=>str_replace('/','',bcrypt(str_random(16))),
        ]);

        if($data["type"]=="acheteur"){ 
            $company = new Company([
                'name'          => $data['company'],
                'phone'         => $data['phone'],
                'address'       => $data['address'],
                'description'   => '',
                'email'         => $data['email'],
                'user_id'       => $user->id
            ]); 
            $user->companies()->save($company);
        } 

        $profile = new Profile([
            'type'       =>$data['type'],
            'company'    =>$data['company'],
            'phone'      =>$data['phone'],
            'address'    =>$data['address'],
            'siret'      =>$data['siret'],
            'firmsize'   =>$data['firmsize'],
            'country_id' =>$data['country_id'],
            'category_id'=>$data['category_id'],
            'activity_id'=>$data['activity_id'], 
        ]); 

        $user->profile()->save($profile); 
        return $user;
    }

    public function confirm($id,$token){
        $user = User::where('id',$id)->where('confirmation_token',$token)->where('active',0)->first();
        if($user){ 
            $user->update(['confirmation_token'=>null]);
            Flashy::message('Votre compte a bien été activé! En attente de validation :)');
            return redirect()->route('login'); 
        }else{
            Flashy::error('Ce lien ne semble pas valide');
            return redirect()->route('login'); 
        }
    }
}
