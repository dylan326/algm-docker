<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Timelog;
use App\Componet;

class ComponetsController extends Controller
{
    public function getTotalSecondsLogged()
    {
        $totalSeconds = DB::table('timelogs')->join('issue_componets', 'timelogs.issue_id', '=', 'issue_componets.issue_id')->select(DB::raw('SUM(timelogs.seconds_logged) as total_seconds, COUNT(timelogs.user_id) as numOfUsers, issue_componets.componet_id'))->groupBy('componet_id')->get();
        
        return $totalSeconds;
    }

    public function outputComponentMetaData()
    {
        $totalSeconds = $this->getTotalSecondsLogged();
    
        return view('componets.index', ['totalSeconds' => $totalSeconds]);
        

    }
  
}
