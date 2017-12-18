<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
	protected $guarded = [];
	
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
    }
}
