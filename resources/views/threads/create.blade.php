@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Thread</div>

                <div class="card-body">

                    <form method="POST" action="{{route('threads.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="channel_id">Choose a channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value=""></option>
                                @foreach ($channels as $channel)
                                    <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input name="title" id="title" type="text" class="form-control" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-primary" type="submit">Post</button>
                        </div>
                        @if (count($errors))
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
