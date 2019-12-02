<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Componet;
use App\Issue;
use App\Timelog;


class ApiController extends Controller
{
    public function getUser()
    {
        
        $client = new \GuzzleHttp\Client;
        //get user api data
        $uri = 'https://my-json-server.typicode.com/bomoko/algm_assessment/users';
        $header = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $res = $client->get($uri, $header);
        $users = json_decode($res->getBody()->getContents(), true);
        //get componet apidata
        $uriCom = 'https://my-json-server.typicode.com/bomoko/algm_assessment/components';
        $headerCom = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $resCom = $client->get($uriCom, $headerCom);
        $componets = json_decode($resCom->getBody()->getContents(), true);
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
        
        
        return $this->inputUsers($users, $componets, $timelogs, $Issuelogs);
        
    }

    public function inputUsers($users, $componets, $timelogs, $Issuelogs)
    {
      
      
      

        $arraySize = sizeof($users);
    
        $u = 0;
         while($u < $arraySize)
         {
           //echo $users[$u]['id']." - ".$users[$u]['name']." - ".$users[$u]['email']."<br>";
           
          $user = new User();
          $user->name = $users[$u]['name'];
          $user->email = $users[$u]['email'];
          $user->save();

           $u++;
         }

        $arraySizeCom = sizeof($componets);
    
        $c = 0;
         while($c < $arraySizeCom)
         {
           //echo $componets[$c]['id']." - ".$componets[$c]['name']."<br>";
           
           $componet = new Componet();
          $componet->name = $componets[$c]['name'];
          $componet->save();

           $c++;
         }


         $arraySizeIssue = sizeof($Issuelogs);
    
         $i = 0;
          while($i < $arraySizeIssue)
          {
            $innerC = 0;
            $componetSize = sizeof($Issuelogs[$i]['components']);
          // echo $Issuelogs[$i]['id']." - ".$Issuelogs[$i]['code'];

           //echo "Componets: ".$Issuelogs[$i]['componets'][$i];

           while($innerC < $componetSize)
           {
           // echo "<hr>Componets: ".$Issuelogs[$i]['components'][$innerC]."<hr>";

              $issue = new Issue();
              $issue->code = $Issuelogs[$i]['code'];
              $issue->componet_id = $Issuelogs[$i]['components'][$innerC];
              $issue->save();

             $innerC++;
           }

            $i++;
          }



        $arraySizeTime = sizeof($timelogs);
    
        $t = 0;
         while($t < $arraySizeTime)
         {
          // echo $timelogs[$t]['id']." - ".$timelogs[$t]['issue_id']." - ".$timelogs[$t]['user_id']." - ".$timelogs[$t]['seconds_logged']."<br>";

          $timelog = new Timelog();
          
          $timelog->issue_id = $timelogs[$t]['issue_id'];
          $timelog->user_id = $timelogs[$t]['user_id'];
          $timelog->seconds_logged = $timelogs[$t]['seconds_logged'];
          $timelog->save();

           $t++;
         }
     
    }
}
