
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-header d-flex justify-content-between">
                    <h2>{{$profileUser->name}}</h2>
                    <h5>Created since {{$profileUser->created_at->diffForHumans()}}</h5>
                </div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                        <article>
                            <div class="d-flex justify-content-between">
                            <a href="{{route('threads.show', [$thread->channel->slug , $thread->id])}}"><h4>{{$thread->title}}</h4></a>
                            <span>{{$thread->created_at->diffForHumans()}}</span>
                            </div>
                            number of replies: {{$thread->replies_count}}
                            <div class="body">{{$thread->body}}</div>
                            <hr>
                        </article>
                    @endforeach
                    {{$threads->links()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
