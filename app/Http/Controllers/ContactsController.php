<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Mail\ContactMessageCreated;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactsController extends Controller
{
    //
    public function create(){
        return view('contacts.create');
    }

    public function store(ContactRequest $request){
         
         $mailable  = new ContactMessageCreated($request->name,$request->email,$request->message);

         Mail::to('ndiayejp@gmailcom')->send($mailable);

         Session::flash('success','Message bien envoyé');

         return redirect()->route('contact_path');
    }
}
