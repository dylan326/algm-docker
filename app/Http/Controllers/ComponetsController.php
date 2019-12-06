<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Timelog;
use App\Componet;

class ComponetsController extends Controller
{
    public function getTotalSecondsLogged()
    {
        $totalSeconds = Timelog::join('issue_componets', 'issue_componets.issue_id', '=', 'timelogs.issue_id')
        ->select(sum('timelogs.seconds_logged as totalSeconds'), 'issue_componets.componet_id as componet_id');

        return $totalSeconds;
    }
    
  
}
