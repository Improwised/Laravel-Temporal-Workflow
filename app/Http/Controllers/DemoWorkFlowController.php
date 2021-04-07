<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Services\WorkflowService;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use App\DemoWorkflow;
use Temporal\Client\WorkflowOptions;
use Carbon\CarbonInterval;

class DemoWorkFlowController extends Controller 
{

	protected  $workflowClient;

	public function __construct()
    {
        $this->workflowClient = WorkflowClient::create(ServiceClient::create('localhost:7233'));
    	
    }

    public function index(Request $request)
    {
        Log::info('Trigger DemoWorkflow');	
		$workflow = $this->workflowClient->newWorkflowStub(
            DemoWorkflow::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

		$run = $this->workflowClient->start($workflow);
		var_dump($run->getExecution()->getID());
    }
}
