<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Website;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Mail;
class PostWebsite extends Controller
{
    //PUBLISH POST WEBSITE
   public function postToWebsite(Request $request)
   {
	   
	   //Mail::to('rajesh.webethics@gmail.com')->send("testfffff");
	   
	   //die;
		$validator = \Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
		'website_id' => 'required',
        ]);
	     
		 $response = array( 'success'=>false,'message' => '');
		 
		 //VALIDATE 
		 if ($validator->fails()) {
				$response['message'] = $validator->messages();
			}else{
		   
		         $website = Website::where('id',$request->website_id)->first();
		         $post = Post::whereRaw('LOWER(name) = ?', [$request->name])->where('website_id',$request->website_id)->first();
		          
				  //IF WEBSITE NOT FOUND 
				  $subscribed_users = Subscriber::select('user_id')->where('website_id',$request->website_id)->get()->toArray();
				
				// send all mail in the queue.
				 $post_data = array('name'=>$request->name,'description'=>$request->description,'website_id'=>$request->website_id);
			
				if(!$website) {  $response['message']="Website Not found"; return $response; };
				  //IF POST IS ALREADY POSTED ON THE WEBSITE.
				if($post) { $response['message']="Post already posted on this website."; return $response; };
		
				$subscribed_users = Subscriber::where('website_id',$request->website_id)->get();
				$post_data = array('name'=>$request->name,'description'=>$request->description,'website_id'=>$request->website_id);
				$post = Post::create($post_data);
				
				//Job for send email to user who subscribe the site.
				$job = (new \App\Jobs\SendPostWebsiteEmailToUser($subscribed_users,$post_data))
					->delay(
						now()
						->addSeconds(10)
					); 
				 dispatch($job);
				
				$response['success']=true;
				$response['message'] = "Post published to the website.";	  			  
		  } 
		
		return $response;
    }
}
