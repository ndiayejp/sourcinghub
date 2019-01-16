<?php

namespace App\Http\Controllers;

use DB;
use App\Profile;
use App\User;
use App\Rating;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class ProfilesController extends Controller
{
    //
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'company' => 'required',
            'image' => 'image',
            'banner' => 'image',
            'about' => 'required',
            'firmsize' => 'required',
            'category_id' => 'required',
            'address' => 'required',
            'siret' => 'required',
            'activity_id' => 'required',
            'phone' => 'required',
            'country_id' => 'required',
            'gallery.*' => 'image|mimes:jpeg,png,gif|max:2048'
        ]);

        $image = $request->file('image');

        $banner = $request->file('banner');

        $user = Profile::where('user_id', Auth::id())->first();

        if (isset($image)) {
             // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName(); 
             
            // Get just filename
            $filename = Profile::cleanCaracteresSpeciaux(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            if ($user->image != 'noimage.jpg') {
                $userImage = public_path("img/profile/{$user->image}");
                unlink($userImage);
            }
            // Upload Image 
            ImageManagerStatic::make($image)->resize(90, 80)->save("img/profile/{$fileNameToStore}");
            $user->image = $fileNameToStore;
        }
        if (isset($banner)) {
             // Get filename with the extension
            $bannerWithExt = $request->file('banner')->getClientOriginalName();
            // Get just filename
            $bannername = Profile::cleanCaracteresSpeciaux(pathinfo($bannerWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extensionbanner = $request->file('banner')->getClientOriginalExtension();
            // Filename to store
            $bannerNameToStore = $bannername . '_' . time() . '.' . $extensionbanner;

            if ($user->banner != 'banner.png') {
                $userBanner = public_path("img/banners/{$user->banner}");
                unlink($userBanner);
            }
            // Upload Image 
            ImageManagerStatic::make($banner)->resize(300, 600)->save("img/banners/{$bannerNameToStore}");
            $user->banner = $bannerNameToStore;
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $file->getClientOriginalExtension();
                //filename to store
                $filenametostore = $filename . '_' . uniqid() . '.' . $extension;
                Storage::put('public/gallery/' . $filenametostore, fopen($file, 'r+'));
                Storage::put('public/gallery/thumbnail/' . $filenametostore, fopen($file, 'r+'));
    
                //Resize image here
                if (!Storage::disk('public')->exists('gallery')) {
                    Storage::disk('public')->makeDirectory('gallery');
                }
                // delete old post image
                if (Storage::disk('public')->exists('gallery/' . $filenametostore)) {
                    Storage::disk('public')->delete('gallery/' . $filenametostore);
                }
                $postImage = Image::make($file)->resize(400, 300)->save();
                Storage::disk('public')->put('gallery/' . $filenametostore, $postImage);

                Gallery::create([
                    'name' => $filenametostore,
                    'user_id' => $user->user_id
                ]);

            }
        }

        $user->company = $request->company;
        $user->address = $request->address;


        $user->about = $request->about;
        $user->firmsize = $request->firmsize;
        $user->phone = $request->phone;
        $user->website = $request->website;
        $user->activity_id = $request->activity_id;
        $user->country_id = $request->country_id;
        $user->category_id = $request->category_id;
        $user->save();
        Session::flash('success', __("Informations bien mises à jour"));
        return redirect()->back();
    }

    public function profile($company, $id)
    {

        $profile = Profile::where('user_id', $id)
            ->with('country')
            ->with('activity')
            ->with('category')
            ->first();

        $galleries = Gallery::where('user_id', $profile->user_id)
            ->get();

        $rate = DB::table('ratings')
            ->where('rateable_id', $id)
            ->sum('rating');

        $nbRates = DB::table('ratings')
            ->where('rateable_id', $id)
            ->count();
        if ($rate > 0) {
            $RateAverage = $rate / $nbRates;
        } else {
            $RateAverage = 0;
        }



        return view('users.profile', compact('profile', 'RateAverage', 'galleries'));
    }

    public function store(Request $request, $id)
    {
        if (!empty($request)) {

            $user = User::find($request->id);

            $getRates = Rating::where('user_id', Auth::id())
                ->where('rateable_id', $id)
                ->get();
            if (!empty($getRates)) {
                $nbCountRate = $getRates->count();
            } else {
                $nbCountRate = 0;
            }

            if ($getRates->count() === 1) {
                Rating::where('rateable_id', $user->id)
                    ->where('user_id', Auth::id())
                    ->update(['rating' => $request->rate]);
            } else {
                $rating = new Rating;
                $rating->rating = $request->rate;
                $rating->user_id = Auth::id();
                $rating->rateable_id = $id;
                $rating->save();
            }
            Session::flash('success', __("Notation bien prise en compte"));
        }
        return redirect()->back();
    }

}
