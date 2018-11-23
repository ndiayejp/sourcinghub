<?php

namespace App\Http\Controllers;

use App\Post;
use App\Invite;
use Illuminate\Http\Request;
use App\Notifications\InviteUser;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class InvitesController extends Controller
{


    protected $rules =
    [
        'email' => 'required|string|max:255',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $emails = explode(',', $request->email);
       
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if(sizeof($emails)>1){
                foreach($emails as $v){ 
                    $invite = new Invite();
                    $invite->post_id = $request->id;
                    $invite->user_id = $request->user;
                    $invite->email = $v;
                    $invite->save();
                }
             }else{
                $invite = new Invite();
                $invite->post_id = $request->id;
                $invite->user_id = $request->user;
                $invite->email = $request->email;
                $invite->save();
             }
            

            $post= Post::where('id',$request->id)->first();

            $users = Invite::all();

            Notification::send($users, new InviteUser($post));
            
            return response()->json(['success'=>'Data is successfully added']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        //
    }
}
