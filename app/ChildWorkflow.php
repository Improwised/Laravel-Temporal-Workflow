<?php
namespace App;

use Temporal\Workflow;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;

#[WorkflowInterface]
class ChildWorkflow
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
            DemoWorkflowActivity::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(2))
        );
    }

    #[WorkflowMethod("Child.greet")]
    public function greet()
    {
        return yield $this->greetingActivity->composeGreeting('Hello Child from');
    }
}
