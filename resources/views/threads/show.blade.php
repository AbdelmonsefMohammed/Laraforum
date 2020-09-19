
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4><a href="#">{{$thread->user->name}}</a> posted: {{$thread->title}}</h4></div>

                <div class="card-body">

                        <article>
                            
                            <div class="body">{{$thread->body}}</div>
                        </article>


                </div>
            </div>
            <br>
            @foreach ($replies as $reply)

            <div class="card">
                
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="#">{{$reply->user->name}}</a> said {{$reply->created_at->diffForHumans()}} ...
                        </div>
                        
                        <form method="POST" action="{{route('favorite.store',['reply'   => $reply->id])}}">
                            @csrf
                            <button type="submit" class="btn btn-primary" {{$reply->isFavorited()? 'disabled':''}}>{{$reply->favorites_count}} Favorite</button>
                        </form>

                    </div>
                </div>
                <div class="card-body">
                    <div class="body">{{$reply->body}}</div>
                </div>
            </div>
            @endforeach

            {{$replies->links()}}
            
            <br>
            @auth
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
            @endauth
            @guest
                <p>Please <a href="{{route('login')}}"> login </a>first to place a comment</p>
            @endguest
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>This thread was published {{$thread->created_at->diffForHumans()}} 
                        by <a href="#">{{$thread->user->name}}</a>
                        and currently has {{$thread->replies_count}} replies
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
