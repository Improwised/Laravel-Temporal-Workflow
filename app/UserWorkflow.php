<?php
namespace App;

use App\Models\User;
use Temporal\Workflow;
use App\GreetingActivity;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Log;

#[Workflow\WorkflowInterface]
class UserWorkflow 
{
    private $greetingActivity;
    
    public function __construct()
    {
        /**
         * Activity stub implements activity interface and proxies calls to it to Temporal activity
         * invocations. Because activities are reentrant, only a single stub can be used for multiple
         * activity invocations.
         */
        $this->greetingActivity = Workflow::newActivityStub(
            GreetingActivity::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(2))
        );
    }

    #[Workflow\WorkflowMethod("GreetMethod")]
    public function greet($userId)
    {
       Log::info('UserWorkflow->greet()',["User" => $userId]); 
       return yield $this->greetingActivity->composeGreeting($userId);
    }
}