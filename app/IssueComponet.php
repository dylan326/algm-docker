<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueComponet extends Model
{
    protected $fillable = ['issue_id', 'componet_id'];

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }

    public function componet()
    {
        return $this->belongsTo('App\Componet');
    }
}
