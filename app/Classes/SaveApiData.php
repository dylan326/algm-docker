<?php

namespace App\Classes;
use App\User;
use App\Component;


class SaveApiData extends PullApiData
{

    public function saveUsersData()
    {
        $users = $this->pullUserApi();

        foreach($users as $user) {
            if(!User::where('name', $user['name'])->where('email', $user['email'])->exists()) {
              User::create(['name' => $user['name'], 'email' => $user['email']]);
            }
          }

          
          
    }

    public function saveComponentsData()
    {
        $components = $this->pullComponentApi();

        foreach($components as $component) {
            if(!Component::where('name', $component['name'])->exists()) {
                Component::create(['name' => $component['name']]);
            }
          }

          
          
    }

    
    
}
