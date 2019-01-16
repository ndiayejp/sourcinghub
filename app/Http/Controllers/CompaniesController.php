<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class CompaniesController extends Controller
{
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        //
        $user = $this->auth->user(); 
        $companies = Company::orderBy('id','desc')->where('user_id',$user->id)->paginate(10);
        return view('companies.index',compact('companies'));
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function create()
    {
         $user = $this->auth->user();
        if($user->user_type==0){ 
            return view('companies.create');
        }
        Session::flash('error',"Vous n'avez pas accés à cette page");
        return redirect()->route('home'); 
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,Company::$rules);

        $user = Auth::user(); 
        $id = Auth::id(); 
        $company = new Company; 
        $company->name = $request->name;
        $company->description = $request->description;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->user_id = $id; 

        if ($request->hasFile('avatarc')) {
            $image = $request->file('avatarc');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'img/avatarsc/'.$filename;
            Image::make($image)->resize(150,150)->save($location);
            $company->avatarc = $filename;
        }
        
        $company->save(); 
        Session::flash('success','votre entreprise a bien été enregistrée');
        return  redirect()->route('companies.create');

    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {  
        $company = Company::findOrFail($id);  
        return view('companies.edit',compact('company'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,Company::$rules); 
        $company = Company::findOrFail($id); 
        if (isset($request->avatarc) && $request->hasFile('avatarc')) { 
            $image = $request->file('avatarc'); 
            $filename = time().'.'.$image->getClientOriginalExtension(); 
            $location = 'img/avatarsc/'.$filename;
            Image::make($image)->resize(150,150)->save($location); 
            Storage::delete('img/avatarsc/'.$company->avatarc);  
        }else{
            $filename = $company->avatarc;
        } 
        $company->update([
            'avatarc'=>$filename,
            'name'=>$request->name,
            'description'=>$request->description,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
        ]); 
        Session::flash('success','votre entreprise a bien été mis à jour'); 
        return redirect(route('companies.index'));
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id); 
        if (!empty($company->avatarc)) { 
            $image = $company->avatarc; 
            Storage::delete('img/avatarsc/'.$image); 
        } 
        $company->delete(); 
        Session::flash('error','Entreprise supprimée'); 
        return redirect(route('companies.index'));
    }


}
