<?php
namespace App\Http\Controllers\Admin;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('admin.unit.index',compact('units'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,Unit::$rules);
        
       
        
        $unit = new Unit();
       
        
        $unit->name = $request->name;
        
        $unit->url_unit = str_slug( $request->name,'-');

        $unit->code = $request->code;
         
        $unit->save();
        Flashy::success('Unité de facturtion ajoutée :)');
        return redirect()->route('admin.unit.index');
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
        $unit = Unit::find($id);
        return view('admin.unit.edit',compact('unit'));
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
         
        
        $unit = Unit::find($id);
        
        $unit->name = $request->name;
        $unit->url_unit = $slug;
        $unit->code = $request->code;
        $unit->save();
        Flashy::message('Unité de facturation bien mise à jour :)');
        return redirect()->route('admin.unit.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        
        $unit->delete();
        Flashy::error('unité de facturation supprimée :)');
        return redirect()->back();
    }
}