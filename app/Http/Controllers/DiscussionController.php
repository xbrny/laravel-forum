<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Topic;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', ['discussions' => Discussion::latest()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create')->with('topics', Topic::all());
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
            'title' => 'required',
            'body' => 'required',
            'topic_id' => 'required'
        ]);

        Discussion::create([
            'title' => request('title'),
            'slug' => str_slug(request('title')),
            'body' => request('body'),
            'topic_id' => request('topic_id'),
            'user_id' => auth()->id(),
        ]);

        session()->flash('success', 'Successfully create a new discussion');

        return redirect()->route('discussions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('discussions.show')->with('discussion', Discussion::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();

        if(!$discussion->isAuthOwner())
        {
            session()->flash('warning', 'You must be owner of this dicussion to perform that action');

            return redirect()->route('home');
        }

        return view('discussions.edit')->with('discussion', $discussion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        
        if(!$discussion->isAuthOwner())
        {
            session()->flash('warning', 'You must be owner of this dicussion to perform that action');

            return redirect()->route('home');
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'topic_id' => 'required',
        ]);

        
        $discussion->title = request('title');
        $discussion->slug = str_slug(request('title'));
        $discussion->body = request('body');
        $discussion->topic_id = request('topic_id');
        $discussion->save();

        session()->flash('success', 'Successfully update the discussion');

        return redirect()->route('discussions.show', ['slug' => $discussion->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        
        if(!$discussion->isAuthOwner())
        {
            session()->flash('warning', 'You must be owner of this dicussion to perform that action');

            return redirect()->route('home');
        }

        $discussion->delete();

        session()->flash('success', 'Successfully delete the discussion');

        return redirect()->route('discussions.index');
    }
}
