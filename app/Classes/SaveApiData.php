<?php

namespace App\Classes;
use App\User;
use App\Component;
use App\Issue;
use App\IssueComponent;
use App\Timelog;


class SaveApiData extends PullApiData
{

  protected $userInserted = 0;
  protected $componentsInserted = 0;
  protected $issuesInserted = 0;
  protected $timelogsInserted = 0;
  protected $allSaved = 0;

    public function saveUsersData()
    {
        $users = $this->pullUserApi();
        //$userInserted = false;

        foreach($users as $user) {
            if(!User::where('name', $user['name'])->where('email', $user['email'])->exists()) {
              $insertUsers = User::create(['name' => $user['name'], 'email' => $user['email']]);
              if($insertUsers)
              {
                $this->userInserted = 1;
              }
            }
          }

     return $this->userInserted;
          
          
    }

    public function saveComponentsData()
    {
        $components = $this->pullComponentApi();

        foreach($components as $component) {
            if(!Component::where('name', $component['name'])->exists()) {
                $insertComponents = Component::create(['name' => $component['name']]);

                if($insertComponents)
              {
                $this->componentsInserted = 1;
              }
            }
          }

          return $this->componentsInserted;
          
    }

    public function saveIssuesData()
    {
      $Issuelogs = $this->pullIssuesApi();

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

          

          
          
    }

    public function saveTimelogsData()
    {
        $timelogs = $this->pullTimelogApi();

        foreach($timelogs as $timelog) {
            if(!Timelog::where('issue_id', $timelog['issue_id'])->where('user_id', $timelog['user_id'])->where('seconds_logged', $timelog['seconds_logged'])->exists()) {
              $insertTimelogs = Timelog::create(['issue_id' => $timelog['issue_id'], 'user_id' => $timelog['user_id'], 'seconds_logged' => $timelog['seconds_logged']]);
              if($insertTimelogs)
              {
                $this->timelogsInserted = 1;
              }
            }
          }

         return $this->timelogsInserted;
          
    }

    public function saveAll($whatLocation)
    {

      $userSaved = $this->saveUsersData();
      $componentSaved = $this->saveComponentsData();
      $issueSaved = $this->saveIssuesData();
      $timelogSaved = $this->saveTimelogsData();

      if($userSaved === 1 && $componentSaved === 1 && $timelogSaved === 1)
      {
        $this->allSaved = 1;
      }

      if($whatLocation != "artisanCommand")
      {
        return redirect()->back();
      }
      else
      {
        return $this->allSaved;
      }
      

    }


    
    
}
