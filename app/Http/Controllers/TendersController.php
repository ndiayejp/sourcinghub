<?php

namespace App\Http\Controllers;

use Validator;
use App\Tender;
use App\ProductTender;
use App\ProviderTender;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InviteProviderNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use App\ProviderReply;

class TendersController extends Controller
{
    //

    protected $limit = 4;
    /**
     * affiche la liste des demandes de quotation coté acheteur
     *
     * @return void
     */
    public function index()
    {
        $tenders = Tender::orderBy('created_at', 'desc')
            ->where('user_id',Auth::user()->id)
            ->paginate($this->limit);
        return view('tenders.index', compact('tenders'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAll(){
        $tenders =  Tender::select('tenders.*',"provider_tenders.*")
            ->leftJoin('provider_tenders', 'provider_tenders.tender_id', '=', 'tenders.id')
            ->where('provider_tenders.email',Auth::user()->email)
            ->where('active',1)
            ->paginate($this->limit);
         
        return view('tenders.quotations', compact('tenders'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function create()
    {
        if(!Auth::user()){
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');  
        }
        return view('tenders.create');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');
        } 

        $validator = Validator::make($request->all(), [ 
                'tender_date'    => 'required|date',
                'name'           => 'required|max:255',
                'body'           => 'required',
                'offer_in_device'=> 'required',
                'product_name.*' => 'required|max:255',
                'product_unit.*' => 'required|min:1',
                'product_qte.*'  => 'required|integer',
                'product_body.*' => 'required|max:255'
            ],
            [
                'tender_date'    => 'choississez une date valide',
                'name'           => 'un titre est nécessaire',
                'body'           => 'le contenu est obligatoire',
                'offer_in_device'=> 'la devise est obligatoire',
                'product_name.*' => 'un nom pour le produit',
                'product_unit.*' => 'une unité est requise',
                'product_qte.*'  => 'une quantité est requise',
                'product_body.*' => 'une description du produit est requise'
            ]
        );  

        $validEmails = str_replace(']',"", str_replace('[', "", str_replace('"', "", $request->emails)));
        
        if(explode(',', $validEmails)){
            $emails  = explode(',', $validEmails);
        } else{
            $emails = $validEmails;
        } 
        if ($validator->fails()) { 
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
        }else{ 
            $tender = new Tender;
            $tender->tender_date = $request->tender_date;
            $tender->name = $request->name;
            $tender->body = $request->body;
            $tender->type = $request->type;
            $tender->offer_in_device  = $request->offer_in_device;
            $tender->active = 0;
            $tender->user_id = Auth::user()->id; 
            if (!empty($request->emails)) { 
                if ($tender->save()) { 
                    if (sizeof($emails) > 1) {
                        foreach ($emails as $v) {
                            $provider = new ProviderTender();
                            $provider->tender_id = $tender->id;
                            $provider->email = $v;
                            $provider->save();
                        }
                    } else { 
                        $provider = new ProviderTender();
                        $provider->tender_id = $tender->id;
                        $provider->email = $emails[0];
                        $provider->save();
                    } 
                    foreach ($request->product_name as $key => $v) { 
                        $data = array(
                            'tender_id' => $tender->id,
                            'name' => $request->product_name[$key],
                            'body' => $request->product_body[$key],
                            'unit' => $request->product_unit[$key],
                            'qte' => $request->product_qte[$key]
                        ); 
                        ProductTender::insert($data);
                    }
                }

                $users = ProviderTender::where('tender_id',$tender->id)->get();
                foreach ($users as $user) {
                    Notification::route('mail', $user->email)
                        ->notify(new InviteProviderNotify($tender));
                }
                Session::flash('success', __("Demande de quotation a bien été créé"));  
            } else {
                Session::flash('error', __("La liste des fournisseurs ne peut etre vide"));
            } 
        }  
        return redirect()->route('tenders.create');
    }

    /**
     * Display the specific resource
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');
        }

        $tender = Tender::with(['products'=>function($query){
                    $query->with(['deals'=>function($q){
                            $q->with(['User'=>function($qq){
                                $qq->with(['Profile']);
                            }]);
                        }]);
                    }])
                    ->with(['deals'=>function($query){
                        $query->with(['User'=>function($query){
                           
                            $query->with(['Profile'=>function($query){
                            }]);
                        }]);
                    }])
                    ->with('user')
                    ->findOrFail($id);
         
         return view('tenders.show', compact('tender'));
        
    }

    /**
     * affiche une demanque de quotation pour le fournisseur
     *
     * @param [type] $id
     * @return void
     */
    public function details($id){
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');
        }
        $tender = Tender::with('products')
                ->with(['deals' => function ($query) {
                $query->where('user_id', Auth::user()->id);
            }])
        ->findOrFail($id);

       

        $getCountReply = ProviderReply::where('user_id', Auth::user()->id)
                                        ->where('tender_id', $id)
                                        ->count();

        $postByOwner = Tender::where('id', $id)
                ->with(['deals' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }])
                ->first();  
              
       
        return view('tenders.details', compact('tender', 'getCountReply', 'postByOwner'));
    }
   

    /**
     * show the form for editing the specific resource 
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');
        } 
        $tender = Tender::with(['products'])->findOrFail($id); 

        $products = ProductTender::where('tender_id', $id)->get();

        $emails = ProviderTender::where('tender_id', $id)->pluck('email');
     
        return view('tenders.edit', compact('tender','products','emails'));
    }
    /**
     * update the specific resource in storage
     *
     * @param Request $request
     * @param [integer] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconnecter"));
            return redirect()->route('login');
        }

        $tender = Tender::find($id); 
        $validator = Validator::make(
            $request->all(),
                [
                    'tender_date'    => 'required|date',
                    'name'           => 'required|max:255',
                    'body'           => 'required',
                    'offer_in_device'=> 'required',
                    'product_name.*' => 'required|max:255',
                    'product_unit.*' => 'required|min:1',
                    'product_qte.*'  => 'required|integer',
                    'product_body.*' => 'required|max:255'
                ],
                [
                    'tender_date'    => 'choississez une date valide',
                    'name'           => 'un titre est nécessaire',
                    'body'           => 'le contenu est obligatoire',
                    'offer_in_device'=> 'devise obligatoire',
                    'product_name.*' => 'un nom pour le produit',
                    'product_unit.*' => 'une unité est requise',
                    'product_qte.*'  => 'une quantité est requise',
                    'product_body.*' => 'une description du produit est requise'
                ]
        );

        $validEmails = str_replace(']', "", str_replace('[', "", str_replace('"', "", $request->emails)));
        $emails = explode(',', $validEmails);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $tender->tender_date = $request->tender_date;
            $tender->name = $request->name;
            $tender->body = $request->body;
            $tender->type = $request->type;
            $tender->offer_in_device = $request->offer_in_device;
            $tender->user_id = Auth::user()->id;
            if (!empty($request->emails)) {
                if ($tender->save()) {
                    if (sizeof($emails) > 1) {
                        foreach ($emails as $v) {
                            DB::table('provider_tenders')
                                ->where('email', $v)
                                ->update([
                                    'email'     =>$v,
                                    'tender_id' =>$tender->id
                            ]);
                        }
                    } else {
                        DB::table('provider_tenders')
                            ->where('email', $emails)
                            ->update([
                                'email'     => $emails,
                                'tender_id' => $tender->id
                            ]);
                    }

                    foreach ($request->product_name as $key => $v) {
                        $data = array(
                            'tender_id' => $tender->id,
                            'name'      => $request->product_name[$key],
                            'body'      => $request->product_body[$key],
                            'unit'      => $request->product_unit[$key],
                            'qte'       => $request->product_qte[$key]
                        );
                        DB::table('product_tenders')
                            ->where('id', $request->product_id[$key])
                            ->update($data);
                    }
                }
                Session::flash('success', __("Demande de quotation a bien été modifiée"));
            } else {
                Session::flash('error', __("La liste des fournisseurs ne peut être vide"));
            }
        }

        return redirect()->route('tenders.index');
         
    }
    
    /**
     * supprime une demande de quotation
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        if (!Auth::user()) {
            Session::flash('error', __("Vous devez vous reconneter"));
            return redirect()->route('login');
        } 
        $tender = Tender::findOrFail($id);
        ProductTender::where('tender_id', $tender->id)->delete();
        ProviderTender::where('tender_id',$tender->id)->delete();
        $tender->delete();
        Session::flash('error', __("Demande supprimée"));
        return redirect()->route('tenders.index');
    }

    /**
    * @param Request $request
    * @param $id integer
    * soumettre à la réponse à une demande de quotation
    */
    public function reply(Request $request, $id){
        if ($request->has('sendQuotation')) {
            $rules = [
                'delivery' => 'required',
            ];
            $messages =  [
                'delivery.required'=>'Le champ délai de livraison est obligatoire',
            ];  
            foreach ($request['price'] as $key => $val) {
                $rules['price.' . $key] = 'required';
                $messages['price.' . $key . '.required'] = 'Le "Prix unitaire ' . $key . '" est obligatoire.';
            }
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($request->hasFile('file')) {
                    $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx', 'rtf', 'xlsx'];
                    $file = $request->file('file');
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $filesize = $file->getClientSize();
                        $check = in_array($extension, $allowedfileExtension);
                        if ($check) {
                            $file->move(public_path() . '/uploads/', $filename); 
                        } else {
                            Session::flash('error', __("Extension de fichier non autorisée"));
                            return redirect()->back()->withInput();
                        }
                }
                else{
                    $filename = "";
                }
                foreach ($request->item_id as $key => $v) {
                    ProviderReply::create([ 
                        'tender_id' => $request->tender_id,
                        'user_id' => $request->user_id,
                        'body'=>$request->body,
                        'file' => $filename,
                        'delivery'=>$request->delivery,
                        'price' => $request->price[$key],
                        'product_id' => $request->item_id[$key], 
                    ]);
                }
                DB::table('tenders')->where('id', $request->tender_id)->increment('replies');
                Session::flash('success', __("Votre offre a bien été transmis"));
                return redirect()->route('tenders.index'); 
            }
        }
    }

}
