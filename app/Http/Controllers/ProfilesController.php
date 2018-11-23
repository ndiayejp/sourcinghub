<?php

namespace App\Http\Controllers;
use DB;
use App\Profile;
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
        $this->validate($request,[
            'company'  => 'required',
            'image' => 'image',
            'banner'=>'image',
            'about'=>'required',
            'firmsize'=>'required',
            'category_id'=>'required',
            'address'=>'required',
            'siret'=>'required',
            'activity_id'=>'required',
            'phone'=>'required',
            'country_id'=>'required'
        ]);

        $image = $request->file('image');

        $banner = $request->file('banner');

        $user = Profile::where('user_id',Auth::id())->first();

         

        if (isset($image))
        {
             // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName(); 
             
            // Get just filename
            $filename = Profile::cleanCaracteresSpeciaux(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            
            if($user->image != 'noimage.jpg'){
                 
                $userImage = public_path("img/profile/{$user->image}");
                 
                unlink($userImage);  
                
            }
            // Upload Image 
            ImageManagerStatic::make($image)->resize(90,80)->save("img/profile/{$fileNameToStore}");

            $user->image = $fileNameToStore;

        }  
        if (isset($banner))
        {
             // Get filename with the extension
            $bannerWithExt = $request->file('banner')->getClientOriginalName();
            // Get just filename
            $bannername = Profile::cleanCaracteresSpeciaux(pathinfo($bannerWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extensionbanner = $request->file('banner')->getClientOriginalExtension();
            // Filename to store
            $bannerNameToStore= $bannername.'_'.time().'.'.$extensionbanner;

            if($user->banner != 'banner.png'){
                 
                $userBanner = public_path("img/banners/{$user->banner}");
                  
                unlink($userBanner);  
                
            }
            // Upload Image
            
            ImageManagerStatic::make($banner)->resize(300,600)->save("img/banners/{$bannerNameToStore}");

            $user->banner = $bannerNameToStore;
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
        Session::flash('success',__("Informations bien mises à jour"));
         return redirect()->back();
    }
    
    public function profile($company,$id){

        $profile = Profile::where('id',$id)
                    ->with('country')
                    ->with('activity')
                    ->with('category')
                    ->first();
        
        return view('users.profile',compact('profile'));
    }
    
}
