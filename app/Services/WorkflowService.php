<?php

namespace App\Services;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WorkflowService;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use App\UserWorkflow;
use Temporal\Client\WorkflowOptions;
use Carbon\CarbonInterval;

class WorkflowService
{
	protected  $workflowClient;

    public function __construct()
    {
        $this->workflowClient = WorkflowClient::create(ServiceClient::create('localhost:7233'));
	}


    public function sendWelcomeEmail(User $user)
    {
    	
		$workflow = $this->workflowClient->newWorkflowStub(
            UserWorkflow::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );
        $run = $this->workflowClient->start($workflow, $user->id);
    }
}