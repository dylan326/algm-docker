<?php

namespace App\Classes;


class PullApiData
{
    
    protected $header = ['headers' => ['X-Auth-Token' => 'My-Token']];
    protected $apiDomain = 'https://my-json-server.typicode.com/bomoko/algm_assessment/';
   


    public function requestApiData($uri)
    {
        $client = new \GuzzleHttp\Client;
        $apiEndPoint = $this->apiDomain.$uri;
        $resolution = $client->get($apiEndPoint, $this->header);

        return json_decode($resolution->getBody()->getContents(), true);

    }


      public function pullUserApi()
      {
          $myUri = "users";

          return $this->requestApiData($myUri);
      }

      public function pullComponentApi()
      {
          $myUri = "components";

          return $this->requestApiData($myUri);
      }
      
      public function pullTimelogApi()
      {
          $myUri = "timelogs";

          return $this->requestApiData($myUri);
      }

      public function pullIssuesApi()
      {
          $myUri = "issues";

          return $this->requestApiData($myUri);
      }
}


  