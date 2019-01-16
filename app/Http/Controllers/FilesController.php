<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FilesController extends Controller
{
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $filename = File::where('id',$id)->pluck('name')->toArray(); 
        $image_path = 'uploads/'.$filename[0];
        unlink($image_path); 
        $file = File::destroy($id);
        return Response::json($file);
    }
}
