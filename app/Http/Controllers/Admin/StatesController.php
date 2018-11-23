<?php
namespace App\Http\Controllers\Admin;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::latest()->get();
        return view('admin.state.index',compact('states'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.state.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,State::$rules);
        
       
        
        $state = new State();
       
        
        $state->name = $request->name;
        
        $state->url_state = str_slug( $request->name,'-');
         
        $state->save();
        Flashy::success('Statut ajoutée :)');
        return redirect()->route('admin.state.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);
        return view('admin.state.edit',compact('state'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
      
         
        $slug = str_slug($request->name);
         
        
        $state = State::find($id);
        
        $state->name = $request->name;
        $state->url_state = $slug;
        $state->save();
        Flashy::message('Statut bien mise à jour :)');
        return redirect()->route('admin.state.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        
        $state->delete();
        Flashy::error('Statut supprimée :)');
        return redirect()->back();
    }
}