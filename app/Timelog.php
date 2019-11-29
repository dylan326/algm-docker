<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    protected $fillable = ['seconds_logged', 'user_id', 'issue_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }
}

