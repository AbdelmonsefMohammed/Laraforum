
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4><a href="#">{{$thread->user->name}}</a> posted: {{$thread->title}}</h4></div>

                <div class="card-body">

                        <article>
                            
                            <div class="body">{{$thread->body}}</div>
                        </article>


                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)

            <div class="card">
                
                <div class="card-header"><a href="#">{{$reply->user->name}}</a> said: At {{$reply->created_at->diffForHumans()}}</div>
                <div class="card-body">
                    <div class="body">{{$reply->body}}</div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
