<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componet extends Model
{
    protected $fillable = ['name'];

    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
}


