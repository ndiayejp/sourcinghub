<?php

namespace App\Http\Controllers\Admin;

use App\Incoterm;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class IncotermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incoterms = Incoterm::latest()->get();
        return view('admin.Incoterm.index',compact('incoterms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.incoterm.create');
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
        $this->validate($request,Incoterm::$rules);
        
       
        
        $incoterm = new Incoterm();
       
        
        $incoterm->name = $request->name;
        $incoterm->code = $request->code;
        
          
        $incoterm->save();
        Flashy::success('incoterm ajoutée :)');
        return redirect()->route('admin.incoterm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function show(Incoterm $incoterm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $incoterm = Incoterm::find($id);
        return view('admin.incoterm.edit',compact('incoterm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required'
        ]);
        
        $incoterm = Incoterm::findOrFail($id);
        
        $incoterm->update([
            'name'=>$request->name,
            'code'=>$request->code,
            
        ]);

        Flashy::message('incoterm bien mise à jour :)');
        return redirect()->route('admin.incoterm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incoterm  $incoterm
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $incoterm = Incoterm::find($id);
       
        $incoterm->delete();
        Flashy::success('Incoterm supprimée :)');
        return redirect()->back();
    }
}
