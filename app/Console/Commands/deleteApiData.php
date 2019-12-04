<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Componet;
use App\Issue;
use App\Timelog;
use App\IssueComponet;

class deleteApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:apidata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the api data in database so I can easily run tests';

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
        $deleteTimelogs = Timelog::query()->truncate();
        $deleteIssueComponets = IssueComponet::query()->truncate();
        $deleteIssues = Issue::query()->truncate();
        $deleteComponets = Componet::query()->truncate();
        $deleteUsers = User::query()->truncate();

        if($deleteTimelogs && $deleteIssueComponets && $deleteIssues && $deleteComponets && $deleteUsers)
        {
            echo "Api data deleted and auto increment reset";

        }
        else
        {
            echo "error";
        }

        
    }
}
