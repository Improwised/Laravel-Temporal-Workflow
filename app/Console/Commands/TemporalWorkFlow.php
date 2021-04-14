<?php
declare(strict_types=1);
namespace App\Console\Commands;


use Temporal\WorkerFactory;
use App\UserWorkflow;
use App\GreetingActivity;
use Illuminate\Console\Command;

ini_set('display_errors', 'stderr');
include "vendor/autoload.php";



/*use Carbon\CarbonInterval;
use Temporal\SampleUtils\DeclarationLocator;
use Temporal\WorkerFactory;
use Temporal\Samples\FileProcessing;*/


class TemporalWorkFlow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:workflow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // factory initiates and runs task queue specific activity and workflow workers
        $factory = WorkerFactory::create();

        // Worker that listens on a task queue and hosts both workflow and activity implementations.
        $worker = $factory->newWorker();

        // Workflows are stateful. So you need a type to create instances.
        $worker->registerWorkflowTypes(UserWorkflow::class);

        // Activities are stateless and thread safe. So a shared instance is used.
        $worker->registerActivityImplementations(new GreetingActivity());
        // To register multiple Activities with the Worker, each Activity implementation name must be unique.
        // And you must provide all Activity function names in the registration call like so:
        // $worker->registerActivityImplementations(new App/ActivityA(), new App/ActivityB(), new App/ActivityC());

        // start primary loop
        $factory->run();
        
    }
}
