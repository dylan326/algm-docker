<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timelog;
use App\User;

class TimelogsController extends Controller
{
    public function getUserTimelogs()
    {
        $userTimelogs = Timelog::join('users', 'users.id', '=', 'timelogs.user_id')->select('users.name as user_name', 'timelogs.seconds_logged as seconds')->get();

        return view('users.index', ['userTimelogs' => json($userTimelogs)]);

    }
    
}
