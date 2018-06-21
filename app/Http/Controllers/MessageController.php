<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;

class MessageController extends Controller
{
    //

    public function retrieveMessage(){
    	$messages = Message::leftJoin('users','messages.userid','=','users.id')->orderBy('messages.created_at','asc')->get();
        // foreach ($messages as $key => $message) {
        //     $messages["classStyle1"] = "";
        //     $messages["classStyle2"] = "my-message";
        //     if($message->userid != Auth::id()){
        //         $messages["classStyle1"] = "align-right";
        //         $messages["classStyle2"] = "other-message";
        //     }
        // }
		return view('widgets/message')->with("messages",$messages)->with("userid",Auth::id());
    }

    public function createMessage(Request $data){
    	if (Auth::check()){
    		$userId = Auth::id();
    		return Message::create([
    			"userid" => $userId,
    			"message" => $data["message"],
    		]);
    	}	
    }
    	
}
