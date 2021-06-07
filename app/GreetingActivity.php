<?php

namespace App;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;
use Temporal\Workflow;
use Temporal\Activity;
use App\Models\User;
use Log;
use Mail;
use App\Mail\SendWelcomeEmail;


#[ActivityInterface(prefix: 'GreetingActivity.')]
class GreetingActivity
{
    #[ActivityMethod(name: "ComposeGreeting")]
	public function composeGreeting($userId)
    {
    	$user = User::find($userId);
    	Log::info('GreetingActivity->composeGreeting()',["user" => $user]); 
    	$message = new SendWelcomeEmail($user); 
    	Mail::to([$user->email])->send($message);
        return true;
    }
}