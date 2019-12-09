<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Timelog;
use App\Component;

class ComponentsController extends Controller
{
    public function getTotalSecondsLogged()
    {
        $totalSeconds = DB::table('timelogs')->join('issue_components', 'timelogs.issue_id', '=', 'issue_components.issue_id')->select(DB::raw('SUM(timelogs.seconds_logged) as total_seconds, COUNT(timelogs.user_id) as numOfUsers, issue_components.component_id'))->groupBy('component_id')->get();
        
        return $totalSeconds;
    }

    public function outputComponentMetaData()
    {
        $totalSeconds = $this->getTotalSecondsLogged();
    
        return view('components.index', ['totalSeconds' => $totalSeconds]);
        

    }
  
}
