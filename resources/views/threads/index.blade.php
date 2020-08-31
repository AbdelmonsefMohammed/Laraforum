@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                        <article>
                            <a href="{{route('thread.show', $thread->id)}}"><h4>{{$thread->title}}</h4></a>
                            <div class="body">{{$thread->body}}</div>
                            <hr>
                        </article>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
