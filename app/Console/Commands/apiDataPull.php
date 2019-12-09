<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Component;
use App\Issue;
use App\Timelog;
use App\IssueComponent;

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
        //return \Redirect::route('users');

        $client = new \GuzzleHttp\Client;
        //get user api data
        $uri = 'https://my-json-server.typicode.com/bomoko/algm_assessment/users';
        $header = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $res = $client->get($uri, $header);
        $users = json_decode($res->getBody()->getContents(), true);
        //get component apidata
        $uriCom = 'https://my-json-server.typicode.com/bomoko/algm_assessment/components';
        $headerCom = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $resCom = $client->get($uriCom, $headerCom);
        $components = json_decode($resCom->getBody()->getContents(), true);
        //get timelog api data
        $uriTime = 'https://my-json-server.typicode.com/bomoko/algm_assessment/timelogs';
        $headerTime = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $resTime = $client->get($uriTime, $headerTime);
        $timelogs = json_decode($resTime->getBody()->getContents(), true);
        //get issues api data
        $uriIssue = 'https://my-json-server.typicode.com/bomoko/algm_assessment/issues';
        $headerIssue = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $resIssue = $client->get($uriIssue, $headerIssue);
        $Issuelogs = json_decode($resIssue->getBody()->getContents(), true);

        $arraySize = sizeof($users);
    
        $u = 0;
         while($u < $arraySize)
         {
           //echo $users[$u]['id']." - ".$users[$u]['name']." - ".$users[$u]['email']."<br>";
          $ifUser = User::where('name', $users[$u]['name'])->where('email', $users[$u]['email'])->first();
          if(!$ifUser)
          {
            $user = new User();
            $user->name = $users[$u]['name'];
            $user->email = $users[$u]['email'];
            $user->save();

          }
         

           $u++;
         }

        $arraySizeCom = sizeof($components);
    
        $c = 0;
         while($c < $arraySizeCom)
         {
           //echo $components[$c]['id']." - ".$components[$c]['name']."<br>";
           $ifcomponent = component::where('name', $components[$c]['name'])->first();
           if(!$ifcomponent)
           {
              $component = new Component();
              $component->name = $components[$c]['name'];
              $component->save();
           }
          

           $c++;
         }


         $arraySizeIssue = sizeof($Issuelogs);
    
         $i = 0;
          while($i < $arraySizeIssue)
          {
            $ifIssue = Issue::where('code', $Issuelogs[$i]['code'])->first();
            if(!$ifIssue)
            {
              $issue = new Issue();
              $issue->code = $Issuelogs[$i]['code'];
              $issue->save();
            }
            

            $innerC = 0;
            $componentSize = sizeof($Issuelogs[$i]['components']);
          

           while($innerC < $componentSize)
           {
           
            $ifIssueComponent = IssueComponent::where('issue_id', $Issuelogs[$i]['id'])->where('component_id', $Issuelogs[$i]['components'][$innerC])->first();
            if(!$ifIssueComponent)
            {
              $issueComponent = new IssueComponent();
              $issueComponent->issue_id = $Issuelogs[$i]['id'];
              $issueComponent->component_id = $Issuelogs[$i]['components'][$innerC];
              $issueComponent->save();
            }
              

             $innerC++;
           }

            $i++;
          }



        $arraySizeTime = sizeof($timelogs);
    
        $t = 0;
         while($t < $arraySizeTime)
         {
          // echo $timelogs[$t]['id']." - ".$timelogs[$t]['issue_id']." - ".$timelogs[$t]['user_id']." - ".$timelogs[$t]['seconds_logged']."<br>";
          $ifTimelog = Timelog::where('issue_id', $timelogs[$t]['issue_id'])->where('user_id', $timelogs[$t]['user_id'])->where('seconds_logged', $timelogs[$t]['seconds_logged'])->first();
         if(!$ifTimelog)
         {
          $timelog = new Timelog();
          $timelog->issue_id = $timelogs[$t]['issue_id'];
          $timelog->user_id = $timelogs[$t]['user_id'];
          $timelog->seconds_logged = $timelogs[$t]['seconds_logged'];
          $timelog->save();

         }
          

           $t++;
         }

         if($ifUser)
         {
             echo "This data already exists in database";
         }
         else{
            echo "Api data pulled and inserted!";
         }
         
    }
}
