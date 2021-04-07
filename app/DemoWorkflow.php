<?php
namespace App;

use Temporal\Workflow;

#[Workflow\WorkflowInterface]
class DemoWorkflow 
{

    #[Workflow\WorkflowMethod(name: "Parent.GreetMethod")]
    public function greet()
    {
        $child = Workflow::newChildWorkflowStub(ChildWorkflow::class);

        // This is a non blocking call that returns immediately.
        // Use yield $child->greet(name) to call synchronously.
        $childGreet = $child->greet();

        // Do something else here.

        return 'Hello from parent; ' . yield $childGreet;
    }
}