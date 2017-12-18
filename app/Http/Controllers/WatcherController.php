<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;

class WatcherController extends Controller
{
    public function watch($id)
    {
    	Watcher::create([
    		'user_id' => auth()->id(),
    		'discussion_id' => $id
    	]);

    	session()->flash('success', 'Successfully watch discussion');

    	return back();
    }

    public function unwatch($id)
    {
    	$watcher = Watcher::where('user_id', auth()->id())->where('discussion_id', $id)->first();

    	$watcher->delete();
    	
    	session()->flash('success', 'Successfully unwatch discussion');

    	return back();
    }
}
