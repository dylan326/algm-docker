<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Component;
use App\Issue;
use App\Timelog;
use App\IssueComponent;
use App\Classes\SaveApiData;

class apiDataPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:apidata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A pull of api endpoint data and ddb population';

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
     * @return mixed
     */
    public function handle()
    {
        $saveApiData = new SaveApiData();

        $apiDataSaved = $saveApiData->saveAll("artisanCommand");

        if($apiDataSaved === 1)
        {
          echo "API data pulled!";
        }
        else
        {
          echo "error, bad JSON data contact administrator";
        }
         
    }
}
