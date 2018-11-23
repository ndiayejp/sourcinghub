<?php
namespace App\Http\Controllers\Admin;
use App\Open;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class OpensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opens = Open::latest()->get();
        return view('admin.open.index',compact('opens'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.open.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,Open::$rules);
        
       
        
        $open = new Open();
       
        
        $open->name = $request->name;
        
        $open->url_open = str_slug( $request->name,'-');
         
        $open->save();
        Flashy::success('Localité marché ajouté :)');
        return redirect()->route('admin.open.index');
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
        $open = Open::find($id);
        return view('admin.open.edit',compact('open'));
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
         
        
        $open = Open::find($id);
        
        $open->name = $request->name;
        $open->url_open = $slug;
        $open->save();
        Flashy::message('Localité marché bien mise à jour :)');
        return redirect()->route('admin.open.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $open = Open::find($id);
        
        $open->delete();
        Flashy::error('Localité marché supprimée :)');
        return redirect()->back();
    }
}