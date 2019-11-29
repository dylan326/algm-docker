<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email'];

    public function timelogs()
    {
        return $this->hasMany('App\Timelog');
    }
}



