<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function discussions()
    {
        return $this->hasMany('App\Discussion');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function upPointsForReply()
    {
        $this->points += 10;
        $this->save();
    }

    public function upPointsForBestAnswer()
    {
        $this->points += 50;
        $this->save();
    }
}
