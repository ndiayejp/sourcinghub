<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::latest()->get();
        return view('admin.city.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::pluck('name', 'id');
        return view('admin.city.create',compact('countries'));
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
        $this->validate($request,City::$rules);
        
       
        
        $city = new City();
       
        
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->url_city = str_slug( $request->name,'-');
         
        $city->save();
        Flashy::success('Ville ajouté :)');
        return redirect()->route('admin.city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $city = City::find($id);
        $countries = Country::pluck('name', 'id');
        return view('admin.city.edit',compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,   $id)
    {
        //
        $this->validate($request,[
            'name' => 'required',
        ]);
      
         
        $slug = str_slug($request->name);
         
        
        $city = City::find($id);
        
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->url_city = $slug;
        
        $city->save();
        Flashy::message('Région bien mise à jour :)');
        return redirect()->route('admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $city = City::find($id);
       
        $city->delete();
        Flashy::error('Région supprimée :)');
        return redirect()->back();
    }
}
