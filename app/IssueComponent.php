<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueComponent extends Model
{
    protected $fillable = ['issue_id', 'component_id'];

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }

    public function component()
    {
        return $this->belongsTo('App\Component');
    }
}
