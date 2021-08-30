<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Website;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class SubscribeToWebsite extends Controller
{
	
   //USER SUBSCRIBE TO WEBSITE
   public function userSubscribeToWebsite(Request $request)
    {
		 $Subscriber = Subscriber::all();
		 
		 $validator = \Validator::make($request->all(), [
        'user_id' => 'required',
        'website_id' => 'required',
        ]);
	     
		 $response = array( 'success'=>false,'message' => '');
		 
		 //VALIDATE 
		 if ($validator->fails()) {
				$response['message'] = $validator->messages();
			}else{
		   
		          $website = Website::where('id',$request->website_id)->first();
		          $user = User::where('id',$request->user_id)->first();
				  if($website && $user){
				  $subscribed = Subscriber::where('user_id',$request->user_id)->where('website_id',$request->website_id)->first();
				  //CHECK IF USER IS ALREADY SUBSCRIBED TO THE WEBSITE OR NOT
				  if($subscribed)
					  $response['message'] = "User already subscribed to the website.";		
				  else{	
					$data = array('user_id'=>$request->user_id,'website_id'=>$request->website_id);
					$Subscriber = Subscriber::create($data);
					$response['success']=true;
					$response['message'] = "User Subscribe to website Successfully.";
				   }	
				  }else{
					$response['message'] = "There is no user or website found."; 
				  }				  
		 } 
		
		return $response;
    }
} 
 