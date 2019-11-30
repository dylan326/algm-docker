<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $uriTime = 'https://my-json-server.typicode.com/bomoko/algm_assessment/components';
        $headerTime = ['headers' => ['X-Auth-Token' => 'My-Token']];
        $resTime = $client->get($uriTime, $headerTime);
        $timelogs = json_decode($resTime->getBody()->getContents(), true);
        //get issues api data
        $uriIssue = 'https://my-json-server.typicode.com/bomoko/algm_assessment/components';
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
           echo $users[$u]['name']."<br>";
           $u++;
         }

        $arraySizeCom = sizeof($componets);
    
        $c = 0;
         while($c < $arraySizeCom)
         {
           echo $componets[$c]['name']."<br>";
           $c++;
         }

         $arraySizeTime = sizeof($timelogs);
    
        $t = 0;
         while($t < $arraySizeTime)
         {
           echo $timelogs[$t]['id']."<br>";
           $t++;
         }

         $arraySizeIssue = sizeof($Issuelogs);
    
         $i = 0;
          while($i < $arraySizeIssue)
          {
            echo $Issuelogs[$i]['id']."<br>";
            $i++;
          }
     
    }
}
