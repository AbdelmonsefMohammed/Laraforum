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
                            <label for="title">Title:</label>
                            <input name="title" id="title" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
