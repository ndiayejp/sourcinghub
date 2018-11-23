<?php


namespace App\Http\Controllers\Admin;
use App\Country;

use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Country::latest()->get();
        return view('admin.country.index',compact('countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,Country::$rules);
        
       
        
        $country = new Country();
       
        
        $country->name = $request->name;
        
        $country->url_country = str_slug( $request->name,'-');
         
        $country->save();
        Flashy::success('Pays ajouté :)');
        return redirect()->route('admin.country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $country = Country::find($id);
        return view('admin.country.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,   $id)
    {
        //
        $this->validate($request,[
            'name' => 'required',
        ]);
      
         
        $slug = str_slug($request->name);
         
        
        $country = Country::find($id);
        
        $country->name = $request->name;
        $country->url_country = $slug;
        $country->save();
        Flashy::message('Pays bien mise à jour :)');
        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $country = Country::find($id);
       
        $country->delete();
        Flashy::error('Pays supprimé :)');
        return redirect()->back();
    }
}
