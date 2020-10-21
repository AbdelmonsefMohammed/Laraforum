@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($threads as $thread)
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <a href="{{route('threads.show', [$thread->channel->slug , $thread->id])}}"><h4>{{$thread->title}}</h4></a>
                    <span>number of replies: {{$thread->replies_count}}</span> 
                </div>

                <div class="card-body">
                    <article>

                        <div class="body">{{$thread->body}}</div>
                    </article>
                </div>
            </div>
            <br>  
            @empty
            <p>There are no relevant results at this time</p>
                
            @endforelse

        </div>
    </div>
</div>
@endsection
