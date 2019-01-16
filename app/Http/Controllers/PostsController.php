<?php

namespace App\Http\Controllers; 
use App\File;
use App\Item;
use App\Open;
use App\Post;
use App\Unit;
use App\User;
use App\Reply;
use App\State;
use App\Assign;
use App\Company;
use App\Country;
use App\Category;
use App\Area;
use App\Incoterm;
use App\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewPostNotify;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

/**
*  class Appel offre 
*/
class PostsController extends Controller
{   
    /**
    * variable pour la pagination
    * @var integer
    */
    protected $limit = 4;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => ['index','getAllPosts']]);
        $this->auth = $auth;
    }

    /**
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if(!Auth::user()){
            Session::flash('error',__("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }

        if($request->has('q')){
            $q = Input::get('q');
            $posts = Post::select("posts.*", "states.url_state", "categories.name as cat_name")
                    ->leftJoin('states', 'states.id', '=', 'posts.state_id')
                    ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                    ->leftJoin('companies','companies.id','=','posts.company_id')
                    ->where('name', 'LIKE', '%' . $q . '%')
                    ->where('user_id',Auth::user()->id)
                    ->paginate($this->limit);
     	}else{
    		$posts = Post::select("posts.*", "states.url_state", "categories.name as cat_name")
                    ->leftJoin('states', 'states.id', '=', 'posts.state_id')
                    ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                    ->leftJoin('companies', 'companies.id', '=', 'posts.company_id')
                    ->where('posts.user_id', Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($this->limit);
        }

        return view('posts.index',compact('posts'));
    }

    /**
    * brouillons
    * @param Request $request
    * @return void
    */
    public function drafts(Request $request){
        if(!Auth::user()){
            Session::flash('error',__("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }

        if($request->has('q')){
            $q = Input::get('q');
    		$posts = Post::where('name','LIKE','%'.$q.'%')
                    ->with('Company')
                    ->with('Category')
                    ->with('State')
                    ->where('active',0)
                    ->where('user_id',Auth::user()->id)
                    ->paginate($this->limit);
     	}else{
    		$posts = Post::orderBy('id','desc')
                    ->with('Company')
                    ->with('Category')
                    ->with('State')
                    ->where('active',0)
                    ->where('user_id',Auth::user()->id)
                    ->paginate($this->limit);
        } 
        
        return view('posts.drafts',compact('posts'));
    }

    /**
    * Appel doffre en cours
    * @param Request $request
    * @return void
    */
    public function inprogress(Request $request){

        if($request->has('q')){ 
            $q = Input::get('q');  
            $posts = Post::select("posts.*", "states.url_state", "categories.name as cat_name") 
            ->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->where('user_id', Auth::user()->id) 
            ->where('states.url_state', '=', "en-cours")
            ->where('posts.name','LIKE','%'.$q.'%')
            ->paginate($this->limit);  
     	}else{  
            $posts = Post::select("posts.*","states.url_state", "categories.name as cat_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('user_id', Auth::user()->id)
            ->where('states.url_state', '=', "en-cours")
            ->paginate($this->limit); 
        }  
        return view('posts.inprogress',compact('posts'));
    }

    /**
    * Appel doffre déjà attribué
    * @param Request $request
    * @return void
    */
    public function archived(Request $request){

        if($request->has('q')){
            $q = Input::get('q'); 
            $posts = Post::where('user_id', Auth::user()->id)
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('states', 'states.id', '=', 'posts.state_id', "categories.name as cat_name")
            ->select("posts.*", 'states.url_state'  )
            ->with('company')
            ->where('states.url_state', '=', "cloture")
            ->orwhere('states.url_state', '=', "attribuer")
            ->where('posts.user_id',Auth::user()->id)
            ->where('posts.name','LIKE','%'.$q.'%')
            ->paginate($this->limit); 
    	 
     	}else{
            $posts = Post::where('user_id', Auth::user()->id)
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->select("posts.*", "categories.name as cat_name", "states.url_state" )
            ->with('company')
            ->where('states.url_state', '=', "cloture")
            ->orwhere('states.url_state', '=', "attribuer")
            ->where('posts.user_id',Auth::user()->id)
            ->paginate($this->limit);  
        } 
        return view('posts.archived',compact('posts'));
    }

    /**
    * Afficher tous les appels doffre coté client
    * @param Request $request
    * @return void
    */
    public function getAllPosts(Request $request){

        if(Auth::user() && Auth::user()->profile()->pluck('type')[0]=='acheteur'){
            Session::flash('error',__("Vous ne pouvez pas accéder à cette page"));
            return redirect()->route('myposts');  
        }

        if(!Auth::user()){
            Session::flash('error',__("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }

        Carbon::setLocale(config('app.locale'));
        $req = $request->all(); 
  
        $builder = Post::orderBy('id','desc')
                     ->Published()->InProgress('en-cours'); 
 
        if (!empty($req['cat'])) {
            $builder->where(function ($query) use ($request) { 
                $query->whereHas('category', function($query) use($request){ 
                    $query->where('categories.id','=', $request->input('cat') ); 
                });
             }); 
        }

        if (!empty($req['area'])) {
            $builder->where(function ($query) use ($request) {
                $query->whereHas('area', function ($query) use ($request) {
                    $query->where('areas.id', '=', $request->input('area'));
                });
            });
        }
        if(!empty($req['open'])){
            $builder->where(function ($query) use ($request) { 
                $query->whereHas('opens', function($query) use($request){ 
                    $query->where('opens.id','=', $request->input('open') ); 
                });
             }); 
        }
        if(!empty($req['country'])){
            $builder->where('country_id',$req['country']) ;
        }
        if(!empty($req['dateDebut']) and !empty($req['dateFin'])){
            $builder->whereBetween('created_at',array($req['dateDebut'],$req['dateFin'])) ;
        }

        if(!empty($req['dateDebutCloture']) and !empty($req['dateFinCloture'])){
            $builder->whereBetween('closing_date',array($req['dateDebutCloture'],$req['dateFinCloture'])) ;
        }

        
        $posts = $builder->paginate($this->limit); 
        $categories = Category::all();
        $areas = Area::all();
        $Allcountries = Country::with(['posts'=>function($q){
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('states.url_state','=','en-cours')
            ->where('posts.active',1) ;
        }])->get();

        $allcats = Category::with(['posts'=>function($q){
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('states.url_state','=','en-cours')
            ->where('posts.active',1) ;
        }])->get();

        $allareas = Area::with(['posts' => function ($q) {
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
                ->where('states.url_state', '=', 'en-cours')
                ->where('posts.active', 1);
        }])->get();
        
        $allopens = Open::with(['posts'=>function($q){
            $q->leftJoin('states', 'states.id', '=', 'posts.state_id')
            ->where('states.url_state','=','en-cours')
            ->where('posts.active',1) ;
            
        }])->get();
       
        return view('posts.getAll',compact('posts','categories',
            'allareas','allcats','allopens',
        'Allcountries'));
    }

    /**
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
    public function create()
    { 
        if(!Auth::user()|| Auth::user()->profile()->pluck('type')[0]!="acheteur"){
            Session::flash('error',__("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }
        $user = $this->auth->user(); 
        $categories = Category::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');
        $companies = Company::where('user_id',$user->id)->get();
        $incoterms = Incoterm::pluck('code','id');
        $countries = Country::pluck('name','id');
        $states = State::pluck('name','id');
        $opens = Open::pluck('name','id');
        $units = Unit::all();
        return view('posts.create',compact('categories','areas','companies',
        'incoterms','countries','states','units','opens'));
        return redirect()->route('home'); 
    }

    /**
    * Store a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request,Post::$rules);
        $post = new Post;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->slug = str_slug($request->name);
        if ($request->has('publish')) {
            $post->active = 0; 
        } else if ($request->has('draft')) {
            $post->active = 0; 
        }
        $post->company_id = $request->company_id;
        $post->user_id = $this->auth->user()->id;
        $post->incoterm_id = $request->incoterm_id;
        $post->state_id = $request->state_id;
        $post->category_id = $request->category_id;
        $post->area_id = $request->area_id;
        $post->country_id = $request->country_id;
        $post->budget = $request->budget;
        $post->closing_date  = $request->closing_date;
        $post->delivery_date  = $request->delivery_date;
        $post->payment_method  = $request->payment_method;
        $post->offer_in_device  = $request->offer_in_device;
        $post->address_delivery  = $request->address_delivery;

        if($post->save()){
            if($request->hasFile('file')){
                $allowedfileExtension=['pdf','jpg','png','docx','rtf','xlsx'];
                $files = $request->file('file'); 
                foreach($files as $file){
                    $filename = $file->getClientOriginalName(); 
                    $extension = $file->getClientOriginalExtension();
                    $filesize = $file->getClientSize();
                    $check=in_array($extension,$allowedfileExtension);
                    if($check) {
                        $file->move(public_path().'/uploads/', $filename);  
                        File::create([
                            'name'    => $filename,
                            'size'    => $filesize,
                            'post_id' => $post->id, 
                        ]);

                    }else{
                        Session::flash('error',__("Extension de fichier non autorisée"));
                        return  redirect()->back()->withInput();
                    }
                }
            }
            $id = $post->id;
            foreach($request->item_unit as $key=>$v){
                $data = array(
                    'post_id'         =>$id,
                    'item_name'       =>$request->item_name[$key],
                    'item_description'=>$request->item_description[$key],
                    'item_unit'       =>$request->item_unit[$key],
                    'item_qte'        =>$request->item_qte[$key] 
                );
                Item::insert($data);
            }
        }

        //$post->categories()->sync($request->categories,false);

        $post->opens()->sync($request->opens,false);
        $users = User::whereHas('profile', function($q){
            $q->where('type', 'fournisseur');
        })->get();
        Notification::send($users, new NewPostNotify($post));
        Session::flash('success',__("Appel d'Offre a bien été créé"));
        return  redirect()->route('posts.create');

    }

    /**
    * Display the specified resource.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        Carbon::setLocale(config('app.locale'));
        $post = Post::Published()
               ->where('slug',$slug)
               ->with(['items'=>function($query){
                   $query->with(['Proposals'=>function($q){
                       $q->with(['User'=>function($qq){
                           $qq->with(['Profile']);
                       }]);
                   }]);
               }])
               ->with('assigns')
               ->with('country')
               ->with('category')
               ->with('area')
                ->with(['replies'=>function($query){
                   $query->with(['User'=>function($query){
                       $query->with(['Profile'=>function($query){
                            
                       }]);
                   }]);
               }])
               ->first();
           
               
        if(Auth::user()->profile()->pluck('type')[0]=="acheteur"){
            if (Auth::user()->id != $post->user_id) {
                Session::flash('error', __("Vous ne pouvez pas accéder à cette page"));
                return redirect('/');
            }

        }
        
        $getAllUserReplies = Proposal::where(
            'user_id', Auth::user()->id)
            ->where('post_id',$post->id)
            ->count();            
                          
        $postByOwner = Post::Published()
            ->where('slug',$slug)
            ->with('items')
            ->with(['proposals'=>function($query){
                $query->where('user_id',Auth::user()->id);
            }])
            ->with('country')
            ->with(['replies'=>function($query){
                 $query->where('user_id',Auth::user()->id);
            }])
            ->first(); 
            
        $getAssigns =  Assign::where('buyer_id', Auth::user()->id)
                ->where('post_id',$post->id)->count(); 
            
        $postKey = 'post_' . $post->id;

        $incoterms = Incoterm::pluck('name','id');
        if (!Session::has($postKey)) {
            $post->increment('view_count');
            Session::put($postKey,1);
        }
       // dd($postByOwner);
        $randomposts = Post::Published()->take(3)->inRandomOrder()->get();
        return view('posts.show',compact('post','incoterms','postByOwner','getAllUserReplies','getAssigns'));
    }

    /**
    * Show the form for editing the specified resource.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    { 
        $post = Post::with(['files'])->findOrFail($id);  
        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts');
            Session::flash('error',__("Vous ne pouvez voir cette offre "));
            return redirect(route('myposts'));
        }  
        if($post->closing_date < date('Y-m-d H:i:s')){
            Session::flash('warning',__("Vous ne pouvez modifier que le statut de l'offre la date de clôture étant dépassée "));
            return redirect(route('myposts'));
        }

        $categories = Category::pluck('name', 'id');
        $areas = Area::pluck('name','id');
        $companies = Company::pluck('name', 'id'); 
        $countries = Country::pluck('name', 'id');
        $incoterms = Incoterm::pluck('name','id');
        $states = State::pluck('name','id');
        $items = Item::where('post_id',$id)->get();
        $units = Unit::all();
        $opens = Open::pluck('name','id'); 
         
        return view('posts.edit',compact('categories','areas','companies','post'
        ,'items','countries','incoterms','states','units','opens'));
    }

    /**
    * Update the specified resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $slug = str_slug($request->name);
        $this->validate($request,Post::$rules);
        $post = Post::find($id); 
        if($post->closing_date < date('Y-m-d H:i:s')){
            Session::flash('warning',__("Seul le statut de l'offre va être modifié "));
            $post->update($request->only('state_id'));
           
        }else{
            $post->name = $request->name;
            $post->description = $request->description;
            $post->slug = $slug;
            
            $post->company_id = $request->company_id;
            $post->user_id =  Auth::id();
            $post->incoterm_id = $request->incoterm_id;
            $post->state_id = $request->state_id;
            $post->category_id = $request->category_id;
            $post->area_id = $request->area_id;
            $post->country_id = $request->country_id;
            $post->budget = $request->budget;
            $post->closing_date  = $request->closing_date;
            $post->delivery_date  = $request->delivery_date;
            $post->payment_method  = $request->payment_method;
            $post->offer_in_device  = $request->offer_in_device;
            $post->address_delivery  = $request->address_delivery;  

            if($post->save()){
                if($request->hasFile('file')){
                    $allowedfileExtension=['pdf','jpg','png','docx','rtf','xlsx'];
                    $files = $request->file('file'); 
                    foreach($files as $file){
                        $filename = $file->getClientOriginalName(); 
                        $extension = $file->getClientOriginalExtension();
                        $filesize = $file->getClientSize();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check) {
                            $file->move('uploads/', $filename);  
                            File::create([
                                'name'    => $filename,
                                'size'    => $filesize,
                                'post_id' => $post->id, 
                            ]);
                        }else{
                            Session::flash('error',__("Extension de fichier non autorisée"));
                            return  redirect()->back()->withInput();
                        }
                    }
                }
                if(!empty($request->item_name)){
                    foreach($request->item_name as $key=>$v){
                        $data = array(
                            'post_id'         =>$post->id,
                            'item_name'       =>$request->item_name[$key],
                            'item_description'=>$request->item_description[$key],
                            'item_unit'       =>$request->item_unit[$key],
                            'item_qte'        =>$request->item_qte[$key] 
                        );
                        DB::table('items')
                        ->where('id', $request->item_id[$key])
                        ->update($data);
                    }  
                }
            }
            if(isset($request->opens)){
                $post->opens()->sync($request->opens);
            }else{
                $post->opens()->sync(array());
            }
        }  
        Session::flash('success',__("Appel d'Offre bien mise à jour"));
        return redirect(route('myposts'));
    }

    /**
    * Remove the specified resource from storage.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != Auth::id())
        {
            Session::flash('error',__("Vous n'êtes pas autorisé à supprimer cette offre"));
            return redirect()->back();
        }  
        $post->delete(); 
        Session::flash('error',__("Appel d'Offre supprimée"));
        return redirect(route('myposts'));
    } 

    /**
    * fonction de recherche
    * @param Request $request
    * @return void
    */
    public function search(Request $request){
        
    }

    /**
    * Get the post from category slug
    * @param  string  $category
    * @return \Illuminate\Http\Response
    */

    public function category(Category $category){
         $categoryName = $category->name;
         $categories = Category::with('posts')->get();
         $allcats = Category::pluck('name','id');
         $posts = $category->posts()
                      ->Published()
                      ->LastestFirst()
                      ->simplePaginate($this->limit);
         return view('posts.getAll',compact('posts','categories','categoryName','allcats'));
    }

    /**
    * offres favorites
    * @return void
    */
    public function favourite(){
        Carbon::setLocale(config('app.locale'));
        $posts = Auth::user()
                ->favorite_posts() 
                ->simplePaginate($this->limit);
        return view('posts.favourite',compact('posts'));       
    }

    /**
    * Répondre à un appel doffre
    * @param Request $request
    * @return void
    */
    public function reply(Request $request){
         if( $request->has('sendPost')){
            $rules = [
                'incoterm_id'   =>'required',
                'payment'       =>'required',
                'amount'        =>'required',
                'delivery'      =>'required',
                'body'          =>'required'
            ];
    
            $messages = [ 
                'incoterm_id.required'   =>"L'incoterm est obligatoire ! ",
                'payment.required'=>"Sélectionnez une méthode de paiement!",
                'amount.required'         =>"Côut du transport, vous pouvez mettre 0 s'il ya pas de frais",
                'delivery.required'      =>"Date de livraison est obligatoire",
                'body.required'          =>"Un commentaire est obligatoire pour finaliser votre offre"
            ];
    
            foreach($request['price'] as $key => $val)
            {
                $rules['price.'.$key] = 'required'; 
                $messages['price.'.$key.'.required'] = 'Le "Prix unitaire '.$key.'" est obligatoire.';
            } 
            
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails()) { 
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
            }else{ 
                foreach($request->item_id as $key=>$v){ 
                    Proposal::create([
                      'price'  =>$request->price[$key],
                      'item_id'=>$request->item_id[$key],
                      'user_id'=>$request->user_id[$key],
                      'post_id'=>$request->post_id[$key], 
                    ]); 
                } 
                if($request->hasFile('file')){ 
                    $allowedfileExtension=['pdf','jpg','png','docx','rtf','xlsx']; 
                    $files = $request->file('file');  
                    $filename = $file->getClientOriginalName();  
                    $extension = $file->getClientOriginalExtension(); 
                    $filesize = $file->getClientSize(); 
                    $check=in_array($extension,$allowedfileExtension); 
                    if($check) { 
                        $file->move('uploads/', $filename);   
                    }else{ 
                        Session::flash('error',__("Extension de fichier non autorisée"));
                        return  redirect()->back()->withInput();
                    } 
                }else {
                    $filename = "";
                }
                $reply = new Reply;
                $reply->payment = $request->payment;
                $reply->body = $request->body;
                $reply->file = $filename;
                $reply->amount =  $request->amount;
                $reply->delivery = $request->delivery;
                $reply->post_id = $request->id;
                $reply->user_id = Auth::id();
                $reply->incoterm_id = $request->incoterm_id; 
                $reply->save();  
                DB::table('posts')->where('id',$request->id)->increment('offers_count'); 
                Session::flash('success',__("Votre offre a bien été transmis"));
                return redirect()->back(); 
            } 
        }         
    } 
}
