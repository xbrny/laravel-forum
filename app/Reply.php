<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
