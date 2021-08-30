<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use Log;
use App\Models\User;
class SendPostWebsiteEmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $userIds;
	 public $post_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userID,$post_data)
    {
                $this->userIds = $userID;
				
                $this->post_data = $post_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		//Log::info( $this->userIds);
         foreach ($this->userIds as $key => $value) {
		
			$user_data = User::where('id',$value['user_id'])->first();
            $to = $user_data->email;
			Log::info($to);
			Mail::to($to)->send(new \App\Mail\SendPostEmailToUser($this->post_data));   
        } 
    }
}
