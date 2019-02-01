<?php

namespace App\Http\Controllers\Admin;

use Image;
use File;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use MercurySeries\Flashy\Flashy;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'end_at' => 'required|date|after:now',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:height=600',
        ]);
        
        $image = $request->file('image');

        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/banners');

        if (!File::exists($destinationPath) ) {
            File::makeDirectory(public_path('banners'));
        }
        
        $img = Image::make($image->getRealPath());

        $img->resize(300, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['imagename']);

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = $input['imagename'];
        $banner->end_at = $request->end_at;
        $banner->link = $request->link;

        if(!isset($request->active)){
            $banner->active = 0;
        }
        else $banner->active = $request->active;

        $banner->save();

        Flashy::success('Bannière ajoutée :)');
        return redirect()->route('admin.banner.index');
    }

    

    /**
     * Show the form for editing the specified resource. 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage. 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'name' => 'required',
            'end_at' => 'required|date|after:now',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:height=600',
        ]);

        $image = $request->file('image');
        if(isset($image)){
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/banners');

            if (!File::exists($destinationPath)) {
                File::makeDirectory(public_path('banners'));
            }
            if (File::exists(public_path('banners/') . $banner->image)) {
                unlink(public_path('banners/' . $banner->image));
            }

            $img = Image::make($image->getRealPath());

            $img->resize(300, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);

            $banner->image = $input['imagename'];
        }
        
        $banner->name = $request->name; 
        $banner->end_at = $request->end_at;
        $banner->link = $request->link;

        if (!isset($request->active)) {
            $banner->active = 0;
        } else $banner->active = $request->active;

        $banner->save();

        Flashy::success('Bannière bien mise à ajoutée :)');
        return redirect()->route('admin.banner.index');
       
    }

    /**
     * Remove the specified resource from storage.
     * @param  Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // delete image in folder
        if(File::exists(public_path('banners/').$banner->image)){
            unlink(public_path('banners/'.$banner->image));
        }
        //delete banner in database
        $banner->delete();
        Flashy::error('Bannière supprimée :)');
        return redirect()->back();
    }
}
