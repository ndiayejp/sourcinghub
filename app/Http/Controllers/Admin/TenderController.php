<?php
namespace App\Http\Controllers\Admin;

use App\Tender;
 use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenders = Tender::with(['products'])
            ->with(['user'=>function($q){
                $q->with('Profile');
            }])
            ->get();
           // dd($tenders);
        return view('admin.tender.index', compact('tenders'));
    }
    
     
     
    public function store(Request $request)
    {
       
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender, Request $request)
    {

        return view('admin.tender.show', compact('tender'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(Tender $tender)
    {

        return view('admin.tender.edit', compact('tender'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tender $tender)
    {
       // dd($request);
        $tender = Tender::find($tender->id);

        $tender->active = $request->active;
        $tender->save();

        Flashy::message('demande de devis mise à jour :)');
        return redirect()->route('admin.tender.index');
    }
     
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    { 
        $tender->delete();
        Toastr::success('Demande de devis supprimée :)', 'Success');
        return redirect()->back();
    }
}