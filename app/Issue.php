<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['code', 'componet_id'];

    public function timelogs()
    {
        return $this->hasMany('App\Timelog');
    }

    public function componet()
    {
        return $this->belongsTo('App\Componet');
    }
}

