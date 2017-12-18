<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Discussion;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('topics.index', Topic::all());
    }

    public function show($id)
    {
        return view('discussions.index')->with('discussions', Discussion::where('topic_id', $id)->latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
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
            'name' => 'required'
        ]);

        Topic::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        session()->flash('success', 'Successfully create a new topic');

        return redirect()->route('topics.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('topics.edit', ['topic' => Topic::where('slug', $slug)->first()]);
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
        $request->validate([
            'name' => 'required'
        ]);

        $topic = Topic::where('slug', $slug)->first();
        $topic->name = request('name');
        $topic->slug = str_slug(request('name'));
        $topic->save();

        session()->flash('success', 'Successfully update the topic');

        return redirect()->route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Topic::where('slug', $slug)->first()->delete();

        session()->flash('success', 'Successfully delete the topic');

        return back();
    }
}
