<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Mail\ContactMessageCreated;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Session;

class ContactsController extends Controller
{
    /**
     * affcher le formulaire de contact
     *
     * @return void
     */
    public function create(){
        return view('contacts.create');
    }

    /**
     * envoie de mail
     *
     * @param ContactRequest $request
     * @return void
     */
    public function store(ContactRequest $request){
         
        $mailable  = new ContactMessageCreated($request->name,$request->email,$request->message);
        Mail::to('ndiayejp@gmailcom')->send($mailable);
        Session::flash('success','Message bien envoyé');
        return redirect()->route('contact_path');
    }
}
