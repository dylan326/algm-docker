<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\User;
use App\Component;
use App\Issue;
use App\Timelog;
use App\IssueComponent;
use Illuminate\Support\Facades\DB;

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
        $deleteIssueComponents = IssueComponent::query()->truncate();
        
        $deleteComponents = Component::query()->delete();
        DB::statement("ALTER TABLE components AUTO_INCREMENT = 1");
        
        $deleteIssues = Issue::query()->delete();
        DB::statement("ALTER TABLE issues AUTO_INCREMENT = 1");

        $deleteUsers = User::query()->delete();
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");

        if($deleteTimelogs && $deleteIssueComponents && $deleteComponents && $deleteIssues && $deleteUsers)
        {
            echo "Api data deleted and auto increment reset";

        }
        else
        {
            echo "error";
        }

        
    }
}
