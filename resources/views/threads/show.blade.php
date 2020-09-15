
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
                
                <div class="card-header"><a href="#">{{$reply->user->name}}</a> said {{$reply->created_at->diffForHumans()}} ...</div>
                <div class="card-body">
                    <div class="body">{{$reply->body}}</div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <br>
    @auth
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('reply.store',[
                    'channel'   => $thread->channel->slug,
                    'thread'    => $thread->id
                ])}}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Have something to say?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endauth
    @guest
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Please <a href="{{route('login')}}"> login </a>first to place a comment</p>
        </div>
    </div>
    @endguest

</div>
@endsection
