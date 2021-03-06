<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Thread;
use App\Reply;
use App\Channel;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {

        $threads = Thread::latest()->filter($filters);

        if($channel->exists)
        {
            $threads = $threads->where('channel_id', $channel->id);
        }
        $threads = $threads->get();

        if(request()->wantsJson()){
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);
        $thread = Thread::create([
            'user_id' => auth()->user()->id,
            'channel_id'   =>  $request->channel_id,
            'title'   =>  $request->title,
            'body'    =>  $request->body

        ]);
        // return redirect('threads/'. $thread->channel->slug .'/' . $thread->id);
        return redirect(route('threads.show',['channel' => $thread->channel->slug,'thread' => $thread->id]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Thread $thread)
    {
        $replies = $thread->replies()->paginate(10);
        return view('threads.show',compact('thread','replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread->replies()->delete();
        $thread->delete();
        if(request()->wantsJson()){
            return response([], 204);
        }
        return redirect('/threads');
    }

    // protected function getThreads(Channel $channel)
    // {
    //     if($channel->exists)
    //     {
    //         $threads = $channel->threads()->latest();
    //     }else{
    //         $threads = Thread::latest();
    //     }
    //     if($username = request('by')){
    //         $user = \App\User::where('name', $username)->firstOrFail();
    //         $threads->where('user_id', $user->id);
    //     }
    //     $threads = $threads->get();
    //     return $threads;
    // }
}
