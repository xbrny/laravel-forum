<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function topic()
    {
    	return $this->belongsTo('App\Topic');
    }

    public function replies()
    {
    	return $this->hasMany('App\Reply');
    }
    
    public function watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function isAuthOwner()
    {
        if($this->user_id != auth()->id())
        {
            return false;
        } else
        {
            return true;
        }
    }

    public function hasBestReply()
    {
        $foundBest = false;

        foreach($this->replies as $reply)
        {
            if($reply->isBest)
            {
                $foundBest = true;
                break;
            }
        }

        return $foundBest;
    }

    public function bestReply()
    {
        return Reply::where('isBest', true)->where('discussion_id', $this->id)->first();
    }

    public function isBeingWatchedByAuth()
    {
        $watcher = Watcher::where('discussion_id', $this->id)->where('user_id', auth()->id())->first();

        if($watcher)
        {
            return true;
        } else
        {
            return false;
        }
    }
}
