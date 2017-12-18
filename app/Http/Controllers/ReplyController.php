<?php

namespace App\Http\Controllers;

use Notification;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $reply = Reply::create([
            'content' => request('content'),
            'user_id' => auth()->id(),
            'discussion_id' => request('discussion_id')
        ]);

        $discussion = Discussion::find(request('discussion_id'));

        $watchers = array();

        foreach($discussion->watchers as $watcher)
        {
            array_push($watchers, $watcher->user);
        }

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($discussion));

        $reply->user->upPointsForReply();

        session()->flash('success', 'Successfully posted answer');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('replies.edit')->with('reply', Reply::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $reply = Reply::find($id);
        $reply->content = request('content');
        $reply->save();

        session()->flash('success', 'Reply updated');

        return redirect()->route('discussions.show', ['discussion' => $reply->discussion->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reply::find($id)->delete();

        session()->flash('success', 'Successfully delete reply');

        return back();
    }

    public function best($id)
    {
        $reply = Reply::find($id);

        if(!$reply->discussion->isAuthOwner())
        {
            session()->flash('warning', 'You must be owner of this dicussion to perform that action');

            return back();
        }

        $message = '';

        if($reply->isBest)
        {
            $reply->isBest = 0;
            $message = 'Unmarked as best answer';
        } else {
            $reply->isBest = 1;
            $reply->user->upPointsForBestAnswer();
            $message = 'Marked as best answer';
        }

        $reply->save();

        session()->flash('success', $message);

        return back();
    }
}
