
<div class="card-header d-flex justify-content-between">
    {{-- <h5>Created since {{$profileUser->created_at->diffForHumans()}}</h5> --}}
    <h3>{{$profileUser->name}} replied to 
        <a href="">{{$activity->subject->thread->title}}</a>
    </h3>
</div>

<div class="card-body">
        <article>
            <div class="d-flex justify-content-between">
            {{-- <a href="{{route('threads.show', [$thread->channel->slug , $thread->id])}}"><h4>{{$thread->title}}</h4></a> --}}
            {{-- <span>{{$thread->created_at->diffForHumans()}}</span> --}}
            </div>
            {{-- number of replies: {{$thread->replies_count}} --}}
            <div class="body">{{$activity->subject->body}}</div>
            <hr>
        </article>
    {{-- {{$threads->links()}} --}}

</div>