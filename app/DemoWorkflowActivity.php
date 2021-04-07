<?php

namespace App;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;
use Temporal\Workflow;
use Temporal\Activity;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Log;


#[Activty\ActivityInterface]
class DemoWorkflowActivity
{
    #[Activty\ActivityMethod(name: "ComposeGreeting")]
	public function composeGreeting(string $greeting): string
    {
    	$info = Activity::getInfo();
        Log::info("workflowId=".$info->workflowExecution->getID());
        Log::info("runId=". $info->workflowExecution->getRunID());
        Log::info("activityId=".$info->id);
        Log::info("activityDeadline=".$info->deadline);

        $user = User::first();
        Log::info('Running DemoWorkflowActivity',["user" => $user]);  
        return $greeting . ' ' . $user->name;
    }
}